@extends('layouts.master-user')
@section('content')

<div class="img-banner">
    <img src="{{asset('/tp-moi.jpg')}}" alt="Banner">
    <div class="text-banner">
        <h1 class="heading1">{{$data->tieude}}</h1>
        <div class="d-flex">
            <div class="item col-4">
                <h4>{{$data->tentaikhoan}} </h4>
            </div>
            <div class="item col-4">
                <h4>{{$data->ngaytao}}</h4>
            </div>
            <div class="item col-4">
                <h4>{{$data->view}} <i class="fa fa-eye" aria-hidden="true"></i></h4>
            </div>
        </div>
    </div>
</div>
<div class="wrap-content container">
    <div class="row">
        <div class="content-left col-8 float-left">
            {!! $data->noidung !!}

            <hr/>
            <h3>Bạn có thể quan tâm</h3>
            <ul>
                <li><a href="#">Khám phá khu du lịch sinh thái Thủy Châu</a></li>
                <li><a href="#">Chùa Tây Tạng - ngôi chùa nổi tiếng nhất Bình Dương</a>
                </li>               
            </ul>
            <br/>          
        </div>
        <div class="content-left col-4 float-right">
            <p>Xem vị trí trên bản đồ</p>
            <div id="mapid1">
                <img src="{{asset('/google-maps.jpg')}}" alt="" style="width: 100%;height: 250px;">
            </div>
            <!-- Modal map -->
                <div class="modal" id="test" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Bản đồ</h5>
                                <button type="button" id="closebutton" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="mapid" style="height: 450px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- js map -->
            <script>
                @foreach($dt as $x) 
                    var mymap = L.map('mapid').setView([{{$x->st_y}},{{$x->st_x}}], 16);
                @endforeach

                var tileLayyer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibHVzaGkiLCJhIjoiY2s0YXFnNHRyMDY2dzNlbGtvM3pwcThhMyJ9.F9DH_aBnwZYWez_5hy3xNA', {
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
                <script src="{{asset('/js/geojson.js')}}"></script>
                <script>
                var json_DuLichpoint1={

                    "type": "FeatureCollection",
                    "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },

                    "features": [
                        @foreach($datadl as $dt)
                            {
                                "type": "Feature",
                                "properties":
                                {
                                    "id": {{$dt->gid}},
                                    "diachi": "{{$dt->diachi}}",                                             
                                    "tendiadiem": "{{$dt->tendiadiem}}",
                                    "tenrutgon": "{{$dt->tenrutgon}}",
                                    "xoa": "xoa{{$dt->gid}}",
                                    "sua": "sua{{$dt->gid}}",
                                    "img": "{{$dt->img}}",
                                    "lng": {{$dt->st_x}},
                                    "lat": {{$dt->st_y}},
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
                                  
                var diadiemdulich = L.geoJson(json_DuLichpoint1, {
                    pointToLayer: function(feature, latlng) {
                        var smallIcon = new L.Icon({
                            iconUrl: '{{asset('/place2.png')}}',
                            iconAnchor: [13, 27],
                            iconSize: [55, 60],

                        });
                        return L.marker(latlng, {icon: smallIcon});
                    },
                    onEachFeature: function (feature, layer)
                    {

                        layer.bindPopup('<div class="container-fluid"><div><img src="'+feature.properties.img+'"style="width:100%;height:200px"></div><div class="text-center"><h4>'+feature.properties.tendiadiem+'</h4></div><div class="row"><label class="col-form-label font-weight-bold"><i class="fa fa-location-arrow" aria-hidden="true"></i>: '+feature.properties.diachi+'</label></div><div class="row"><span class="col-5"><a href="'+feature.properties.url+'" class="float-left"><i class="fa fa-info-circle" aria-hidden="true"></i> Chi tiết</a></span></div></div>');

                    },

                }).addTo(mymap);

                var json_KhachSan={

                    "type": "FeatureCollection",
                    "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },

                    "features": [
                        @foreach($dataks as $dt)
                            {
                                "type": "Feature",
                                "properties":
                                {
                                    "id": {{$dt->gid}},
                                    "diachi": "{{$dt->diachi}}",
                                    "tenkhachsan": "{{$dt->tenkhachsan}}",
                                    "xoa": "xoa{{$dt->gid}}",
                                    "sua": "sua{{$dt->gid}}",
                                    "lng": {{$dt->st_x}},
                                    "lat": {{$dt->st_y}},
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
                    var khachsan = L.geoJson(json_KhachSan, {
                    pointToLayer: function(feature, latlng) {
                        
                        return L.marker(latlng);
                    },
                    onEachFeature: function (feature, layer)
                    {
                        layer.bindTooltip('<div class="container-fluid"><div class="form-group text-center"><h4>Tên khách sạn: '+feature.properties.tenkhachsan+'</h4></div><div class="form-group"><label class="col-form-label font-weight-bold">Địa chỉ: '+feature.properties.diachi+'</label></div></div>');
                    },

                    }).addTo(mymap);

                    document.getElementById("mapid1").onclick = function () {
                        $('#test').modal('show');
                        setTimeout(function() {
                            mymap.invalidateSize(false);
                        }, 100);
                    }

                    document.getElementById("closebutton").onclick = function () {
                        $('#test').modal('hide');
                    }

                    
            </script>
            <hr/>
            <h3>Các bài viết cùng chủ đề</h3> 
            <ul>
                <li><a href="#">Khám phá khu du lịch sinh thái Thủy Châu</a></li>
                <li><a href="#">Chùa Tây Tạng - ngôi chùa nổi tiếng nhất Bình Dương</a></li>               
            </ul>
            
        </div>
    </div>
</div>
@endsection