@extends('layouts.master-user')
@section('content')
<div class="img-banner">
    <img src="{{asset('/tp-moi.jpg')}}" alt="Banner">
    <div class="text-banner text-center">
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
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header mt-3">                     
                                    <div class="col-5">
                                        <h5 class="modal-title" id="exampleModalLabel">Bản đồ</h5>
                                    </div>
                                    <div class="col-3 float-right">
                                        <form autocomplete="off" class="form-group" action="#">
                                            <div class="autocomplete input-group mx-auto">
                                                <div class="row">
                                                    <input id="myInput" 
                                                            type="text" 
                                                            name="myCountry"
                                                            placeholder="Tên khách sạn ..." 
                                                            aria-label="Search">
                                                    <div class="input-group-append">
                                                        <button type="button" id="myBtn" class="btn btn-navbar">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-2 float-right">
                                        <button type="button" id="closebutton" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                
                            </div>
                            <div class="modal-body">
                                <div id="mapid" style="height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- js map -->
            <script>
                @foreach($dt as $x) 
                    var mymap = L.map('mapid').setView([{{$x->st_y}},{{$x->st_x}}], 16);
                

                    var tileLayyer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibHVzaGkiLCJhIjoiY2s0YXFnNHRyMDY2dzNlbGtvM3pwcThhMyJ9.F9DH_aBnwZYWez_5hy3xNA', {
                        maxZoom: 18,
                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                        id: 'mapbox/streets-v11',
                        tileSize: 512,
                        zoomOffset: -1
                    }).addTo(mymap);

                    var circle = L.circle([{{$x->st_y}},{{$x->st_x}}], {
                        color: 'red',
                        fillColor: '#f03',
                        fillOpacity: 0.1,
                        radius: 3000
                    }).addTo(mymap);
                    </script>
                    <script src="{{asset('/js/geojsondata.js')}}"></script>
                    <script src="{{asset('/js/geojson.js')}}"></script>
                    <script>
                    var json_DuLichpoint1={

                        "type": "FeatureCollection",
                        "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },

                        "features": [
                            
                                {
                                    "type": "Feature",
                                    "properties":
                                    {
                                        "id": {{$x->gid}},
                                        "diachi": "{{$x->diachi}}",                                             
                                        "tendiadiem": "{{$x->tendiadiem}}",
                                        "tenrutgon": "{{$x->tenrutgon}}",
                                        "xoa": "xoa{{$x->gid}}",
                                        "sua": "sua{{$x->gid}}",
                                        "img": "{{$x->img}}",
                                        "lng": {{$x->st_x}},
                                        "lat": {{$x->st_y}},
                                        "url": "danh-gia/{{$x->tenlink}}",
                                    },
                                    "geometry":
                                    {
                                        "type": "Point",
                                        "coordinates": [ {{$x->st_x}}, {{$x->st_y}} ],
                                    },
                                },
                            
                        ]
                    }
                                    
                    var diadiemdulich = L.geoJson(json_DuLichpoint1, {
                        pointToLayer: function(feature, latlng) {
                            var smallIcon = new L.Icon({
                                iconUrl: '{{asset('/place2.png')}}',
                                iconAnchor: [25, 41],
                                iconSize: [55, 70],

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
                                                    "img": "{{$dt->img}}",
                                                    "sao": "{{$dt->sao}}",
                                                    "link": "khach-san/{{$dt->tenlink}}",
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
                            var pointx = L.marker([{{$x->st_y}}, {{$x->st_x}}]);
                            var latlngx = pointx.getLatLng();
                            var pointy = L.marker([feature.properties.lat, feature.properties.lng]);
                            var latlngy = pointy.getLatLng();
                            var z = (latlngx.distanceTo(latlngy)).toFixed(0)/1000;
                            var star = parseInt(feature.properties.sao);
                            layer.bindTooltip('<div class="container-fluid"><div><img src="'+feature.properties.img+'"style="width:275px;height:200px"></div><div class="text-center"><h4>'+feature.properties.tenkhachsan +'<div class="hotel-rating"><span class="text-star"><i class="number"> '+feature.properties.sao +' sao </i></span><span class="bg-star">@for($i='+feature.properties.sao+';$i>1;$i--)<i class="fa fa-star"></i>@endfor</span></div></h4></div><div class="row"><label class="col-form-label font-weight-bold"><i class="fa fa-location-arrow" aria-hidden="true"></i>: '+feature.properties.diachi+'</label></div><div class="form-group"><label class="col-form-label font-weight-bold">Khoảng cách: '+z+' km</label></div></div>');
                            layer.on('click', function(e) {
                                window.location = "http://localhost:8080/DoAnTotNghiep/public/"+feature.properties.link;
                        });
                            
                        },

                        filter: function(feature,layer)
                        {
                            var pointx = L.marker([{{$x->st_y}}, {{$x->st_x}}]);
                            var latlngx = pointx.getLatLng();
                            var pointy = L.marker([feature.properties.lat, feature.properties.lng]);
                            var latlngy = pointy.getLatLng();
                            var z = (latlngx.distanceTo(latlngy)).toFixed(0)/1000;
                            if(z<3 || z == 3)
                                return true;
                            else
                                return false;
                        },

                        }).addTo(mymap);
                        
                        var khachsan1 = L.geoJson(json_KhachSan, {
                        pointToLayer: function(feature, latlng) {
                            var smallIcon = new L.Icon({
                                // shadowUrl: 'https://unpkg.com/leaflet@1.6.0/dist/images/marker-shadow.png',
                                iconUrl: 'https://unpkg.com/leaflet@1.6.0/dist/images/marker-icon.png',
                                iconSize: [20, 30],
                                // shadowSize: [20, 30],      
                                // iconAnchor: [2, -20],
                                
                                
                            });
                            
                            return L.marker(latlng,{icon: smallIcon});
                        },
                        
                        onEachFeature: function (feature, layer)
                        {
                            var pointx = L.marker([{{$x->st_y}}, {{$x->st_x}}]);
                            var latlngx = pointx.getLatLng();
                            var pointy = L.marker([feature.properties.lat, feature.properties.lng]);
                            var latlngy = pointy.getLatLng();
                            var z = (latlngx.distanceTo(latlngy)).toFixed(0)/1000;
                            layer.bindTooltip('<div class="container-fluid"><div><img src="'+feature.properties.img+'"style="width:275px;height:200px"></div><div class="text-center"><h4>'+feature.properties.tenkhachsan +'<div class="hotel-rating"><span class="text-star"><i class="number"> '+feature.properties.sao +' sao </i></span><span class="bg-star">@for($i=0;$i<'+star+';$i++)<i class="fa fa-star"></i>@endfor</span></div></h4></div><div class="row"><label class="col-form-label font-weight-bold"><i class="fa fa-location-arrow" aria-hidden="true"></i>: '+feature.properties.diachi+'</label></div><div class="form-group"><label class="col-form-label font-weight-bold">Khoảng cách: '+z+' km</label></div></div>');
                            layer.on('click', function(e) {
                                window.location = "http://localhost:8080/DoAnTotNghiep/public/"+feature.properties.link;
                            });
                        },

                        filter: function(feature,layer)
                        {
                            var pointx = L.marker([{{$x->st_y}}, {{$x->st_x}}]);
                            var latlngx = pointx.getLatLng();
                            var pointy = L.marker([feature.properties.lat, feature.properties.lng]);
                            var latlngy = pointy.getLatLng();
                            var z = (latlngx.distanceTo(latlngy)).toFixed(0)/1000;
                            if(z>3)
                                return true;
                            else
                                return false;
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
                        
                        // data for autocomplete
                        var countries = [
                                            
                                            "{{$x->tendiadiem}}",
                                            "{{$x->tenrutgon}}",                               
                                            
                                            @foreach($dataks as $ks)
                                            "{{$ks->tenkhachsan}}",                               
                                            @endforeach
                                        ];
                            // console.log(countries);
                            
                        // js show popup when click search button

                        $(document).ready(function(){
                            // Get value on button click and show alert
                            $("#myBtn").click(function(){
                                var str = $("#myInput").val();
                                
                                diadiemdulich.eachLayer(function(feature){
                                    if(feature.feature.properties.tendiadiem==str || feature.feature.properties.tenrutgon==str){
                                        feature.openPopup();
                                        mymap.flyTo(L.latLng(feature.feature.properties.lat,feature.feature.properties.lng),12);              
                                    }
                                    
                                });

                                khachsan.eachLayer(function(feature){
                                    if(feature.feature.properties.tenkhachsan==str){
                                        feature.openTooltip();
                                        mymap.flyTo(L.latLng(feature.feature.properties.lat,feature.feature.properties.lng),12);
                                    }
                                
                                });

                                khachsan1.eachLayer(function(feature){
                                    if(feature.feature.properties.tenkhachsan==str){
                                        feature.openTooltip();
                                        mymap.flyTo(L.latLng(feature.feature.properties.lat,feature.feature.properties.lng),12);
                                    }
                                
                                });
                            });
                        });

                    @endforeach
                    
                    // mymap.on('click', function(e){
                    //     khachsan.eachLayer(function(feature){
                    //         var pointx = L.marker([feature.feature.properties.lat, feature.feature.properties.lng]);
                    //         var latlngx = pointx.getLatLng();
                    //         if(latlngx == e.latlng)
                    //         {
                    //             console.log(latlngx);
                    //             console.log(e.latlng);
                    //         }
                    //     });
                    //     // window.location='login';
                    // });
            </script>
            <script src="{{asset('/user/js/trangchu_autocomplete.js')}}"></script>
            <script>
                autocomplete(document.getElementById("myInput"), countries);
                
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