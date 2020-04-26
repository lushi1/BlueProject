@extends('layouts.master-user')
@section('content')
<link rel="stylesheet" href="{{asset('/user/css/autocomplete.css')}}">
<link rel="stylesheet" href="{{asset('/admin/css/qltk.css')}}">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<div class="dashboard-ecommerce">
<div class="row m-3">
    <!-- Panel map -->
    <div class="pane-container col-3 border border-primary">
        <!-- Search Form -->
        <form autocomplete="off" class="form-group mt-3" action="#">
            
            <div class="autocomplete input-group mx-auto">
                <div class="row">

                    <input id="myInput" 
                            type="text" 
                            name="myCountry"
                            placeholder="Search" 
                            aria-label="Search">

                    <div class="input-group-append">
                        <button type="button" id="myBtn" class="btn btn-navbar">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <!-- End search form -->

        <!-- Show and hide form -->
        <form class="form-group">            
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="exampleRadios" id="showdl" checked>
                <label class="form-check-label" for="exampleRadios1">
                    Show
                </label>
                
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="exampleRadios" id="hidedl">
                <label class="form-check-label" for="exampleRadios2">
                    Hide
                </label>
            </div>
            <br/>
            <div class="form-check form-check-inline">            
                <label class="form-check-label font-weight-bold" for="exampleRadios2">
                    Địa điểm du lịch
                </label>
            </div>
        </form>

        <form class="form-group">            
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="exampleRadios" id="showks" checked>
                <label class="form-check-label" for="exampleRadios1">
                    Show
                </label>
                
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="exampleRadios" id="hideks">
                <label class="form-check-label" for="exampleRadios2">
                    Hide
                </label>
            </div>
            <br/>
            <div class="form-check form-check-inline">            
                <label class="form-check-label font-weight-bold" for="exampleRadios2">
                    Địa điểm khách sạn
                </label>
            </div>
        </form>

        <form class="form-group">       
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="exampleRadios" id="showvung" checked>
                <label class="form-check-label" for="exampleRadios1">
                    Show
                </label>
                
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="exampleRadios" id="hidevung">
                <label class="form-check-label" for="exampleRadios2">
                    Hide
                </label>
            </div>
            <br/>
            <div class="form-check form-check-inline">            
                <label class="form-check-label font-weight-bold" for="exampleRadios2">
                    Vùng (tỉnh Bình Dương)
                </label>
            </div>
        </form>
        <!-- <a href="#" onclick="focusOn('paris')">Paris</a> -->
        <!-- End show and hide form -->
    </div>
    <!-- End panel map -->
    <!-- Map -->
    <div class="canvas-container col-9">       
        <div id="mapid" style="height: 550px;"></div>
        <script>

            var mymap = L.map('mapid')
                        .setView([11.20465, 106.69412], 10);

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
          
            var diadiemdulich = L.geoJson(json_DuLichpoint1, {
                pointToLayer: function(feature, latlng) {
                    
                    return L.marker(latlng);
                },
                onEachFeature: function (feature, layer)
                {

                    layer.bindPopup('<div class="container-fluid"><div class="form-group text-center"><h4>Tên địa điểm: '+feature.properties.tendiadiem+'</h4></div><div class="form-group"><label class="col-form-label font-weight-bold">Địa chỉ: '+feature.properties.diachi+'</label></div></div>');
                },
                // filter: function(feature,layer)
                // {
                //     return true;
                // },

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
                    var smallIcon = new L.Icon({
                            iconUrl: 'hotel.png',
                            iconAnchor: [13, 27],
                            iconSize: [27, 27],

                    });
                    return L.marker(latlng, {icon: smallIcon});
                },
                onEachFeature: function (feature, layer)
                {

                    layer.bindPopup('<div class="container-fluid"><div class="form-group text-center"><h4>Tên khách sạn: '+feature.properties.tenkhachsan+'</h4></div><div class="form-group"><label class="col-form-label font-weight-bold">Địa chỉ: '+feature.properties.diachi+'</label></div></div>');
                },

                }).addTo(mymap);

            // Js show and hide places to visit
            $("#hidedl").click(function() {
                mymap.removeLayer(diadiemdulich)
            });
            
            $("#showdl").click(function() {
                mymap.addLayer(diadiemdulich)
            });

            $("#hideks").click(function() {
                mymap.removeLayer(khachsan)
            });
            
            $("#showks").click(function() {
                mymap.addLayer(khachsan)
            });

            $("#hidevung").click(function() {
                mymap.removeLayer(huyenDauTieng)
                mymap.removeLayer(huyenBauBang)
                mymap.removeLayer(thixaBenCat)
                mymap.removeLayer(tpThuDauMot)
                mymap.removeLayer(thixaThuanAn)
                mymap.removeLayer(thixaDiAn)
                mymap.removeLayer(thixaTanUyen)
                mymap.removeLayer(huyenPhuGiao)
                mymap.removeLayer(huyenBacTanUyen)
            });
            
            $("#showvung").click(function() {
                mymap.addLayer(huyenDauTieng)
                mymap.addLayer(huyenBauBang)
                mymap.addLayer(thixaBenCat)
                mymap.addLayer(tpThuDauMot)
                mymap.addLayer(thixaThuanAn)
                mymap.addLayer(thixaDiAn)
                mymap.addLayer(thixaTanUyen)
                mymap.addLayer(huyenPhuGiao)
                mymap.addLayer(huyenBacTanUyen)
            });


            

                // data for autocomplete
                var countries = [
                                    @foreach($datadl as $dl)
                                    "{{$dl->tendiadiem}}",                               
                                    @endforeach
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
                            if(feature.feature.properties.tendiadiem==str){
                                feature.openPopup();
                                mymap.flyTo(L.latLng(feature.feature.properties.lat,feature.feature.properties.lng),11);              
                            }
                            
                        });

                        khachsan.eachLayer(function(feature){
                            if(feature.feature.properties.tenkhachsan==str){
                                feature.openPopup();
                                mymap.flyTo(L.latLng(feature.feature.properties.lat,feature.feature.properties.lng),11);
                            }
                        
                        });
                    });
                });
            </script>
            <script src="{{asset('/user/js/trangchu_autocomplete.js')}}"></script>
            <script>
                autocomplete(document.getElementById("myInput"), countries);
            </script>
        
    </div>
    <!-- End map -->
</div>
@endsection