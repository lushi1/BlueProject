@extends('layouts.master-admin')
@section('content')
<link rel="stylesheet" href="{{asset('/admin/css/qltk.css')}}">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- Noi dung -->

                    <div class="row mb-3"></div>
                    <div class="card">
                        <div class="card-header">
                            <div class="row float-left" style="font-size: 20px;">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a class="text-primary" href="#">Quản lý khách sạn</a></li>
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
                            var json_KhachSanpoint1={
                                
                                "type": "FeatureCollection",
                                "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
                                                                                                                
                                "features": [
                                    @foreach($data as $dt)
                                        { 
                                            "type": "Feature", 
                                            "properties": { 
                                                "tenkhachsan": "{{$dt->tenkhachsan}}" }, 
                                                "geometry": {   "type": "Point", 
                                                                "coordinates": [ {{$dt->st_x}}, {{$dt->st_y}} ], 
                                                            },
                                        },
                                    @endforeach
                                ]
                            }                        
                            var khachsan = L.geoJson(json_KhachSanpoint1, {  
                                pointToLayer: function(feature, latlng) {
                                    var smallIcon = new L.Icon({                               
                                            iconUrl: 'hotel.png',
                                            iconAnchor: [13, 27],
                                            iconSize: [27, 27],                    
                                                                
                                    });
                                    return L.marker(latlng, {icon: smallIcon});
                                },                       
                                onEachFeature: function (feature, layer)
                                {     
                        
                                    layer.bindPopup('<div class="container-fluid"><div class="form-group"><p>Tên khách sạn: '+feature.properties.tenkhachsan+'</p><p>Tên khách sạn: '+feature.properties.tenkhachsan+'</p></div><div class="row"><div class="col-6"><form action="themKS" method="POST">@csrf<button type="submit" class="btn btn-info">Sửa</button></form></div><div class="col-6"><form action="themKS" method="POST">@csrf<button type="submit" class="btn btn-danger">Xóa</button></form></div></div></div>');
                                },
                                                        
                            }).addTo(mymap);
                            var popup = L.popup({minWidth : 200},);

                                function onMapClick(e) {
                                    popup                              
                                        .setLatLng(e.latlng)
                                        .setContent('<h1><span class="badge badge-dark text-center">Thêm Khách Sạn</span></h1><form action="themKS" method="POST">@csrf<div class="form-group"><label>Tên khách sạn: </label><input type="text" class="form-control" aria-describedby="emailHelp" name="tenkhachsan" placeholder="Vd: Phương Nam" required></div><div class="form-group"><div class="row"><div class="col-6"><label>Tọa độ X: </label><input type="text" class="form-control" value="'+e.latlng.lng+'" name="toadox" readonly></div><div class="col-6"><label>Tọa độ Y: </label><input type="text" class="form-control" name="toadoy" value="'+e.latlng.lat+'" readonly></div></div></div><button type="submit" class="btn btn-primary">Thêm</button>')
                                        .openOn(mymap);
                                }

                                mymap.on('click', onMapClick);
                            </script>
                            <script src="{{asset('/js/geojson.js')}}"></script>
<div class="container-fluid"><div class="form-group"><p>Tên khách sạn: </p><p>Tên khách sạn: </p></div><div class="row"><div class="col-6"><form action="themKS" method="POST">@csrf<button type="submit" class="btn btn-info">Sửa</button></form></div><div class="col-6"><form action="themKS" method="POST">@csrf<button type="submit" class="btn btn-info">Xóa</button></form></div></div></div>
                            <!-- Ket thuc card body -->
                        </div>
                        <!-- Ket thuc noi dung -->
                        
                    </div>
                </div>
            </div>
@endsection