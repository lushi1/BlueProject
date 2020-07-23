@extends('layouts.master-admin')
@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src={{ url('editor/ckfinder/ckfinder.js') }}></script>
<div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- Noi dung -->

                    <div class="row mb-3"></div>
                    <div class="card">
                        <div class="card-header">
                            <div class="row float-left" style="font-size: 20px;">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active" aria-current="page">Quản lý điểm du lịch</li>
                                    </ol>
                                </nav>
                               
                            </div>
                            <div class="row float-left pl-4">
                                @if ( Session::has('success') )
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <strong>{{ Session::get('success') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif
                                @if ( Session::has('error') )
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <strong>{{ Session::get('error') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif
                            </div>
                            <!-- SEARCH FORM -->
                            <form class="form-inline ml-3 float-right mt-3">
                            <div class="input-group input-group-md">
                                <input class="input-custom border-0" type="search" placeholder="Search" aria-label="Search">
                                <div class="searchicon-custom input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                </div>
                            </div>
                            </form>
                        </div>


                        <div class="card-body">
                        <div class="row">
                                <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><h3 >Form Thêm</h3></a>
                            </div>
                            <div class="collapse p-2 m-2" id="collapseExample" style="border: 1px solid;">                            
                                <form action="themDL" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label class="col-form-label font-weight-bold">Tên điểm du lịch<span class="text-danger"> (*)</span></label>
                                            <input type="text" class="form-control" name="tendiadiem">
                                        </div>
                                        <div class="form-group col-4">
                                            <label class="col-form-label font-weight-bold">Tên link du lịch<span class="text-danger"> (*)</span></label>
                                            <input type="text" class="form-control" name="tenlink">
                                        </div>
                                        <div class="form-group col-4">
                                            <label class="col-form-label font-weight-bold">Tên rút gọn<span class="text-danger"> (*)</span></label>
                                            <input type="text" class="form-control" name="tenrutgon">
                                        </div>
                                        <div class="form-group col-4">
                                            <label class="col-form-label font-weight-bold">Huyện,xã<span class="text-danger"> (*)</span></label>
                                            <input type="text" class="form-control" id="idvung" name="idvung" readonly>
                                        </div>
                                        <div class="form-group col-2">
                                            <label class="col-form-label font-weight-bold">Tọa độ lng<span class="text-danger"> (*)</span></label>
                                            <input type="text" class="form-control" id="toadox1" name="toadox" value="">
                                        </div>
                                        <div class="form-group col-2">
                                            <label class="col-form-label font-weight-bold">Tọa độ lat<span class="text-danger"> (*)</span></label>
                                            <input type="text" class="form-control" id="toadoy1" name="toadoy" value="">
                                        </div>
                                        <div class="form-group col-4">
                                            <label class="col-form-label font-weight-bold">Địa chỉ<span class="text-danger"> (*)</span></label>
                                            <textarea class="form-control col-12" name="diachi" cols="60" rows="1"></textarea>
                                        </div>
                                        <div class="form-group col-4">
                                            <label class="col-form-label font-weight-bold">Ảnh<span class="text-danger"> (*)</span></label>
                                            <img class="form-control" name="url" id="url" style="height:150px">
                                        </div>
                                        <div class="form-group col-4">
                                            <label class="col-form-label font-weight-bold">Url ảnh<span class="text-danger"> (*)</span></label>
                                            <input type="text" class="form-control" id="url1" name="url1">
                                            <button type="button" class="form-group btn btn-success" onclick="openPopup()">Select file</button>
                                        </div>
                                    </div>
                                    <div class="row p-3">
                                        <button type="submit" class="btn btn-primary">Thêm</button>
                                    </div>
                                </form>
                                
                            </div>
                            <div id="mapid" style="width: 800; height: 500px;"></div>
                            <script>

                                var mymap = L.map('mapid').setView([10.980692, 106.674437], 13);

                                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibHVzaGkiLCJhIjoiY2s0YXFnNHRyMDY2dzNlbGtvM3pwcThhMyJ9.F9DH_aBnwZYWez_5hy3xNA', {
                                    maxZoom: 18,
                                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                                        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                    id: 'mapbox/streets-v11',
                                    tileSize: 512,
                                    zoomOffset: -1
                                }).addTo(mymap);
                            </script>
                            <script src="{{asset('/js/geojsondata.js')}}"></script>

                            <script>
                            var json_DiaDiemDuLich={

                                "type": "FeatureCollection",
                                "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },

                                "features": [
                                    @foreach($data as $dt)
                                        {
                                            "type": "Feature",
                                            "properties":
                                            {
                                                "id": {{$dt->gid}},
                                                "diachi": "{{$dt->diachi}}",                                             
                                                "tendiadiem": "{{$dt->tendiadiem}}",
                                                "src": "{{$dt->img}}",
                                                "xoa": "xoa{{$dt->gid}}",
                                                "sua": "sua{{$dt->gid}}",
                                                "url": "danh-gia/{{$dt->tenlink}}",
                                                
                                            },
                                            "geometry":
                                            {
                                                "type": "Point",
                                                "coordinates": [ {{$dt->st_x}}, {{$dt->st_y}} ],
                                            },
                                        },
                                    @endforeach
                                ]
                            }


                            

                            var dulich = L.geoJson(json_DiaDiemDuLich, {
                                pointToLayer: function(feature, latlng) {
                                    
                                    return L.marker(latlng);
                                },
                                onEachFeature: function (feature, layer)
                                {
                                    layer.bindPopup('<div class="container-fluid"><div><img src="'+feature.properties.src+'"style="width:100%;height:200px"></div><div class="text-center"><h4>'+feature.properties.tendiadiem+'</h4></div><div class="row"><label class="col-form-label font-weight-bold"><i class="fa fa-location-arrow" aria-hidden="true"></i>: '+feature.properties.diachi+'</label></div><div class="row"><span class="col-5"><a href="'+feature.properties.url+'" class="float-left"><i class="fa fa-info-circle" aria-hidden="true"></i> Chi tiết</a></span></div><div class="row"><div class="col-6"><span data-toggle="modal" data-target="#'+feature.properties.sua+'"><button type="button" class="btn btn-info">Sửa</button></span></div><div class="col-6">  <span data-toggle="modal" data-target="#'+feature.properties.xoa+'"><button type="button" class="btn btn-danger float-right">Xóa</button></span></div></div></div>');
                                },
                            }).addTo(mymap);
                            // var popup = L.popup({minWidth : 300},);

                            //     function onMapClick(e) {
                            //         popup
                            //             .setLatLng(e.latlng)
                            //             .setContent('<form action="themDL" method="POST">@csrf<div class="form-group"><label>Tên địa điểm: </label><input type="text" class="form-control" aria-describedby="emailHelp" name="tendiadiem" placeholder="Vd: Phương Nam" required></div><div class="row"><div class="form-group col-6"><label class="col-form-label font-weight-bold">Địa chỉ: <span class="text-danger"> (*)</span></label></div><textarea class="form-control col-12" name="diachi" cols="60" rows="2"></textarea></div><div class="form-group"><div class="row"><div class="col-6"><label>Tọa độ X: </label><input type="text" class="form-control" value="'+e.latlng.lng+'" name="toadox" required></div><div class="col-6"><label>Tọa độ Y: </label><input type="text" class="form-control" name="toadoy" value="'+e.latlng.lat+'" required></div></div></div><div class="form-group text-center"><div class="col-12"><label>Ảnh:</label><img name="url" id="url" style="width:80%;height:100px"></div><label>Url:</label><input type="text" size="40" name="url1" id="url1" /> <button type="button" onclick="openPopup()">Select file</button></div><button type="submit" class="btn btn-primary">Thêm</button></form>')
                            //             .openOn(mymap);
                            //     }

                            //     mymap.on('click', onMapClick);
                            </script>
                            <script src="{{asset('/js/geojson.js')}}"></script>

                            <!-- Ket thuc card body -->
                        </div>
                        <!-- Ket thuc noi dung -->

                    </div>
                </div>
            </div>
            @foreach($data as $dt)

                <!-- Edit Form -->

                <form action="{{route('suaDL',['id' => $dt->gid])}}" method="post">
                    @csrf
                    <div class="modal fade" id="sua{{$dt->gid}}" tabindex="-1" role="dialog"aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="editModalLabel">Sửa Điểm Du Lịch</h2>
                                    <button type="button" class="close"data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label class="col-form-label font-weight-bold">Ảnh: <span class="text-danger"> (*)</span></label>
                                            <img name="suaimg{{$dt->gid}}" id="suaimg{{$dt->gid}}" src="{{$dt->img}}" style="width:100%;height:200px">
                                        </div>
                                        <div class="form-group col-6">
                                            <label class="col-form-label font-weight-bold">Url: <span class="text-danger"> (*)</span></label>
                                            <input type="text" class="form-control" name="img" id="suainput{{$dt->gid}}" value="{{$dt->img}}"/> 
                                            <button class="btn btn-info mt-2" type="button" onclick="openPopup1('suainput{{$dt->gid}}','suaimg{{$dt->gid}}')">Select file</button>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label class="col-form-label font-weight-bold">Tên địa điểm: <span class="text-danger"> (*)</span></label>
                                            <input type="text" class="form-control" name="tendiadiem" value="{{$dt->tendiadiem}}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label class="col-form-label font-weight-bold">Địa chỉ: <span class="text-danger"> (*)</span></label>
                                            <textarea class="form-control col-12" name="diachi" cols="60" rows="2">{{$dt->diachi}}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label class="col-form-label font-weight-bold">Tên link địa điểm: <span class="text-danger"> (*)</span></label>
                                            <input type="text" class="form-control" name="tenlink" value="{{$dt->tenlink}}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label class="col-form-label font-weight-bold">Tên rút gọn: <span class="text-danger"> (*)</span></label>
                                            <input type="text" class="form-control" name="tenrutgon" value="{{$dt->tenrutgon}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label class="col-form-label font-weight-bold">Tọa độ x: <span class="text-danger"> (*)</span></label>
                                            <input type="text" class="form-control" name="toadox" value="{{$dt->st_x}}" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label class="col-form-label font-weight-bold">Tọa độ y: <span class="text-danger"> (*)</span></label>
                                            <input type="text" class="form-control" name="toadoy" value="{{$dt->st_y}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Sửa</button>
                                    <button type="button" class="btn btn-default float-left" data-dismiss="modal">Hủy</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Kết thúc Edit Form -->

                <!-- Delete Form -->

                <form action="{{route('xoaDL',['id' => $dt->gid])}}" method="post">
                    @csrf
                    <div class="modal fade" id="xoa{{$dt->gid}}" tabindex="-1" role="dialog"aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="deleteModalLabel">Xóa Địa Điểm</h2>
                                    <button type="button" class="close"data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                    <h5>Bạn có chắc muốn xóa địa điểm <span class="font-weight-bold font-italic">"{{$dt->tendiadiem}}"</span></h5>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                    <button type="button" class="btn btn-default float-left" data-dismiss="modal">Hủy</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Ket thuc Delete Form -->
            @endforeach
            
     <script>
        // js thêm DL
        function openPopup() {
            CKFinder.popup( {
                language: 'de',
                chooseFiles: true,
                onInit: function( finder ) {
                    finder.on( 'files:choose', function( evt ) {
                        var file = evt.data.files.first();
                        document.getElementById( 'url' ).src = file.getUrl();
                        document.getElementById( 'url1' ).value = file.getUrl();
                        console.log(file.getUrl());
                    } );
                    finder.on( 'file:choose:resizedImage', function( evt ) {
                        document.getElementById( 'url' ).value = evt.data.resizedUrl;
                        document.getElementById( 'url1' ).value = evt.data.resizedUrl;
                    } );
                }
            } );
        }
        // js sửa DL
        function openPopup1(input,img) {
            CKFinder.popup( {
                chooseFiles: true,
                onInit: function( finder ) {
                    finder.on( 'files:choose', function( evt ) {
                        var file = evt.data.files.first();
                        document.getElementById( img ).src = file.getUrl();                   
                        document.getElementById( input ).value = file.getUrl();
                        
                        // console.log(file.getUrl());
                        console.log(document.getElementById( input ).value);
                    } );
                    finder.on( 'file:choose:resizedImage', function( evt ) {
                        document.getElementById( img ).src = evt.data.resizedUrl;
                        document.getElementById( input ).value = evt.data.resizedUrl;
                    } );
                }
            } );
        }

         //tim idvung
         vung.on('click', function(e) {
            console.log(e.layer.feature.properties.ID);
            console.log(e.latlng.lng);
            var toandox1 = document.getElementById("toadox1").value= e.latlng.lng;
            var toandoy1 = document.getElementById("toadoy1").value= e.latlng.lat;
            var idvung = document.getElementById("idvung").value= e.layer.feature.properties.TEN;
        });
    </script>
@endsection