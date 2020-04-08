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
                        <div id="mapid" style="width: 800; height: 600px;"></div>
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
                        <script src="{{asset('/js/geojson.js')}}"></script>
                        </div>
                        <!-- Ket thuc noi dung -->
                    </div>
                </div>
            </div>
@endsection