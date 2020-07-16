@extends('layouts.master-user')
@section('content')
<link rel="stylesheet" href="{{asset('/user/css/trangchu.css')}}">
<link rel="stylesheet" href="{{asset('/user/css/autocomplete.css')}}">
    <div class="dashboard-ecommerce">
    <div class="row m-3">
        <!-- Panel map -->
        <div class="pane-container col-3 border border-primary">
            <!-- Search Form -->
            
            <form autocomplete="off" class="form-group mt-3">
                
                <div class="autocomplete input-group mx-auto">
                    <div class="row">
                        <div class="col-9 float-left">
                            <input id="myInput"
                                    type="text" 
                                    name="myCountry"
                                    placeholder="Tìm kiếm" 
                                    aria-label="Tìm kiếm" class="form-group" style="width:100%;">     
                        </div>
                        <div class="input-group-append form-group col-2 float-right">
                            <button type="button" id="myBtn" class="btn btn-navbar" style="background: #f1f1f1;">
                            <i class="fas fa-search"></i> 
                            </button>
                        </div>
                        <div class="feedback pl-4">
                            <p class="text-danger" id="checkNull"></p>
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

            <!-- <form class="form-group">            
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
            </form> -->

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
                        // var smallIcon = new L.Icon({
                        //         iconUrl: 'place.png',
                        //         iconAnchor: [13, 27],
                        //         iconSize: [27, 27],

                        // });
                        var smallIcon = new L.DivIcon({
                            iconAnchor: [13, 13],
                            iconSize: [70, 20],
                            className: 'my-div-icon',
                            html: '<div class="row"><img class="my-div-image" src="place.png"/>'+
                                '<span class="my-div-span align-self-center">'+feature.properties.tendiadiem+'</span></div>'

                        });
                        return L.marker(latlng, {icon: smallIcon});
                    },
                    onEachFeature: function (feature, layer)
                    {

                        layer.bindPopup('<div class="container-fluid"><div><img src="'+feature.properties.img+'"style="width:100%;height:200px"></div><div class="text-center"><h4>'+feature.properties.tendiadiem+'</h4></div><div class="row"><label class="col-form-label font-weight-bold"><i class="fa fa-location-arrow" aria-hidden="true"></i>: '+feature.properties.diachi+'</label></div><div class="row"><span class="col-5"><a href="'+feature.properties.url+'" class="float-left"><i class="fa fa-info-circle" aria-hidden="true"></i> Chi tiết</a></span></div></div>');

                    },
                    // filter: function(feature,layer)
                    // {
                    //     return true;
                    // },

                }).addTo(mymap);

                // var json_KhachSan={

                //     "type": "FeatureCollection",
                //     "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },

                //     "features": [
                //         @foreach($dataks as $dt)
                //             {
                //                 "type": "Feature",
                //                 "properties":
                //                 {
                //                     "id": {{$dt->gid}},
                //                     "diachi": "{{$dt->diachi}}",
                //                     "tenkhachsan": "{{$dt->tenkhachsan}}",
                //                     "xoa": "xoa{{$dt->gid}}",
                //                     "sua": "sua{{$dt->gid}}",
                //                     "lng": {{$dt->st_x}},
                //                     "lat": {{$dt->st_y}},
                //                     "img": "{{$dt->img}}",
                //                     "sao": {{$dt->sao}},
                //                 },
                //                 "geometry":
                //                 {
                //                     "type": "Point",
                //                     "coordinates": [ {{$dt->st_x}}, {{$dt->st_y}} ],
                //                 },
                //             },
                //         @endforeach
                //     ]
                //     }




                //     var khachsan = L.geoJson(json_KhachSan, {
                //     pointToLayer: function(feature, latlng) {
                        
                //         var smallIcon = new L.DivIcon({
                //             iconAnchor: [13, 27],
                //             iconSize: [65, 30],
                //             className: 'my-div-icon',
                //             html: '<div class="row"><img class="my-div-image" src="hotel.png"/>'+
                //                 '<span class="my-div-span align-self-center">'+feature.properties.tenkhachsan+'</span></div>'

                //         });
                //         return L.marker(latlng, {icon: smallIcon});
                //     },
                //     onEachFeature: function (feature, layer)
                //     {
                        
                //         layer.bindPopup('<div class="container-fluid"><div><img src="'+feature.properties.img+'"style="width:275px;height:200px"></div><div class="text-center"><h4>'+feature.properties.tenkhachsan +'<div class="hotel-rating"><span class="text-star"><i class="number"> '+feature.properties.sao +' sao </i></span><span class="bg-star">@for($i=0;$i<4;$i++)<i class="fa fa-star"></i>@endfor</span></div></h4></div><div class="row"><label class="col-form-label font-weight-bold"><i class="fa fa-location-arrow" aria-hidden="true"></i>: '+feature.properties.diachi+'</label></div><div class="row"><span class="col-5"><a href="#" class="float-left"><i class="fa fa-info-circle" aria-hidden="true"></i> Chi tiết</a></span><span class="col-7"><a href="#" class="float-right"><i class="fa fa-h-square" aria-hidden="true"></i> Xem khách sạn gần đó</a></span></div></div>');
                        
                        
                //     },

                //     }).addTo(mymap);

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
                                        "{{$dl->tenrutgon}}",                               
                                        @endforeach
                                        
                                    ];
                                    // @foreach($dataks as $ks)
                                    //     "{{$ks->tenkhachsan}}",                               
                                    //     @endforeach
                        // console.log(countries);
                    
                    // js show popup when click search button

                    $(document).ready(function(){
                        // Get value on button click and show alert
                        $("#myBtn").click(function(){
                            var str = $("#myInput").val();
                            var check = false;
                            if(str != "")
                            {
                                diadiemdulich.eachLayer(function(feature){
                                    if(feature.feature.properties.tendiadiem==str || feature.feature.properties.tenrutgon==str){
                                        feature.openPopup();
                                        check = true;
                                        
                                        mymap.flyTo(L.latLng(feature.feature.properties.lat,feature.feature.properties.lng),12);              
                                    }
                                    
                                });
                                if(check==true){
                                        document.getElementById("checkNull").innerHTML ="";                    
                                    }
                                else{
                                    document.getElementById("checkNull").innerHTML =str+" không có trong dữ liệu";
                                }
                                
                            }                      
                            else{
                                document.getElementById("checkNull").innerHTML ="Bạn chưa nhập dữ liệu";
                                   
                            }

                            // khachsan.eachLayer(function(feature){
                            //     if(feature.feature.properties.tenkhachsan==str){
                            //         feature.openPopup();
                            //         mymap.flyTo(L.latLng(feature.feature.properties.lat,feature.feature.properties.lng),12);
                            //     }
                            
                            // });
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

    <div class="common-place">
        <div class="space-10px">
        </div>
        <div class="title-common-place text-center">
            <h2>ĐIỂM DU LỊCH PHỔ BIẾN</h2>
        </div>
        <div class="img-common-place">
            <div class="row m-3">
                @foreach($datadlnb as $dtdlnb)
                <div class="img-div float-left col-4" style="padding-bottom: 20px;">
                    <a href="danh-gia/{{$dtdlnb->tenlink}}">
                        <img src="{{$dtdlnb->img}}" alt="img">
                        <div class="place-content">
                            <h3>{{$dtdlnb->tendiadiem}}</h3>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="space-40px">
        </div>
    </div>

    <div class="common-place">
        <div class="space-10px">
        </div>
        <div class="title-common-place text-center">
            <h2>KHÁCH SẠN NỔI TIẾNG</h2>
        </div>
        <div class="img-common-place">
            <div class="row m-3">
                @foreach($dataksnb as $dtksnb)
                <div class="img-div float-left col-4" style="padding-bottom: 20px;">
                    <a href="khach-san/{{$dtksnb->tenlink}}">
                        <img src="{{$dtksnb->img}}" alt="img">
                        <div class="place-content">
                            <h3>{{$dtksnb->tenkhachsan}}</h3>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="space-40px">
        </div>
    </div>
@endsection