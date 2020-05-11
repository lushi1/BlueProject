@extends('layouts.master-admin')
@section('content')
<link rel="stylesheet" href="{{asset('/admin/css/qltk.css')}}">
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
                                        <li class="breadcrumb-item"><a class="text-primary" href="#">Quản lý địa điểm du lịch</a></li>
                                    </ol>
                                </nav>
                               
                            </div>
                        </div>


                        <div class="card-body">

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
                                    layer.bindPopup('<div class="container-fluid"><div><img src="'+feature.properties.src+'"style="width:auto%;height:200px"></div><div class="form-group text-center"><h4>'+feature.properties.tendiadiem+'</h4></div><div class="row"><div class="form-group"><label class="col-form-label font-weight-bold">Địa chỉ: '+feature.properties.diachi+'</label></div></div><div class="row"><div class="col-6"><span data-toggle="modal" data-target="#'+feature.properties.sua+'"><button type="button" class="btn btn-info">Sửa</button></span></div><div class="col-6">  <span data-toggle="modal" data-target="#'+feature.properties.xoa+'"><button type="button" class="btn btn-danger float-right">Xóa</button></span></div></div></div>');
                                },
                            }).addTo(mymap);
                            var popup = L.popup({minWidth : 300},);

                                function onMapClick(e) {
                                    popup
                                        .setLatLng(e.latlng)
                                        .setContent('<form action="themDL" method="POST">@csrf<div class="form-group"><label>Tên địa điểm: </label><input type="text" class="form-control" aria-describedby="emailHelp" name="tendiadiem" placeholder="Vd: Phương Nam" required></div><div class="row"><div class="form-group col-6"><label class="col-form-label font-weight-bold">Địa chỉ: <span class="text-danger"> (*)</span></label></div><textarea class="form-control col-12" name="diachi" cols="60" rows="2"></textarea></div><div class="form-group"><div class="row"><div class="col-6"><label>Tọa độ X: </label><input type="text" class="form-control" value="'+e.latlng.lng+'" name="toadox" required></div><div class="col-6"><label>Tọa độ Y: </label><input type="text" class="form-control" name="toadoy" value="'+e.latlng.lat+'" required></div></div></div><div class="form-group text-center"><div class="col-12"><label>Ảnh:</label><img name="url" id="url" style="width:80%;height:100px"></div><label>Url:</label><input type="text" size="40" name="url1" id="url1" /> <button onclick="openPopup()">Select file</button></div><button type="submit" class="btn btn-primary">Thêm</button></form>')
                                        .openOn(mymap);
                                }

                                mymap.on('click', onMapClick);
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
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="editModalLabel">Sửa Khách Sạn</h2>
                                    <button type="button" class="close"data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label class="col-form-label font-weight-bold">Tên địa điểm: <span class="text-danger"> (*)</span></label>
                                            <input type="text" class="form-control" name="tendiadiem" value="{{$dt->tendiadiem}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label class="col-form-label font-weight-bold">Địa chỉ: <span class="text-danger"> (*)</span></label>
                                            
                                        </div>
                                        <textarea class="form-control col-12" name="diachi" cols="60" rows="4">{{$dt->diachi}}</textarea>
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
            <!-- <form action="themDL" method="POST">@csrf<div class="form-group"><label>Tên địa điểm: </label><input type="text" class="form-control" aria-describedby="emailHelp" name="tendiadiem" placeholder="Vd: Phương Nam" required></div><div class="row"><div class="form-group col-6"><label class="col-form-label font-weight-bold">Địa chỉ: <span class="text-danger"> (*)</span></label></div><textarea class="form-control col-12" name="diachi" cols="60" rows="2"></textarea></div><div class="form-group"><div class="row"><div class="col-6"><label>Tọa độ X: </label><input type="text" class="form-control" value="'+e.latlng.lng+'" name="toadox" required></div><div class="col-6"><label>Tọa độ Y: </label><input type="text" class="form-control" name="toadoy" value="'+e.latlng.lat+'" required></div></div></div><div class="form-group text-center"><div class="col-12"><label>Ảnh:</label><img name="url" id="url" style="width:80%;height:100px"></div><label>Url:</label><input type="text" size="30" name="url1" id="url1" /> <button onclick="openPopup()">Select file</button></div><button type="submit" class="btn btn-primary">Thêm</button></form> -->
            
     <script>
        function openPopup() {
            CKFinder.popup( {
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
    </script>
@endsection