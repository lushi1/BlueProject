@extends('layouts.master-user')
@section('content')
<link rel="stylesheet" href="{{asset('/user/css/trangchu.css')}}">
<link rel="stylesheet" href="{{asset('/user/css/autocomplete.css')}}">
<link rel="stylesheet" href="{{asset('/user/css/khachsan.css')}}">

<div class="contentPage container">
    <div class="breadcrumb-div mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('trang-chu')}}">Trang chủ</a></li>
                <li class="breadcrumb-item">Khách sạn</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="map_search">
            <div class="col-3 float-left p-2" id="mapid1">
                <img src="{{asset('/google-maps.jpg')}}" alt="img" style="width: 100%; height: 100px">
                <div class="place-content">
                    <p>Xem bản đồ</p>
                </div>
            </div>
            <!-- Modal map -->
            
            <div class="modal" id="test" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header mt-3">                     
                                <div class="col-2 float-left">
                                    <h5 class="modal-title" id="exampleModalLabel">Bản đồ</h5>
                                </div>
                                <div class="col-6 float-left">
                                    <form autocomplete="off" class="form-group" action="#">
                                        <div class="autocomplete input-group mx-auto form-group">
                                        <div class="row">
                                        <div class="pl-3 float-left">
                                            <p class="text-danger" id="checkNull"></p>
                                        </div>
                                        </div>
                                            <div class="row" style="width:100%;">
                                                <div class="col-10 float-left">
                                                        <input id="myInput" 
                                                                type="text" 
                                                                name="myCountry"
                                                                placeholder="Tên khách sạn ..." 
                                                                aria-label="Search" style="width:100%;height:100%;">
                                                </div>
                                                <div class="input-group-append col-2 float-right">
                                                    <button type="button" id="myBtn" class="btn btn-info">
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
            <div class="col-9 float-right pl-4" style="width: 100%; height: 100%">
                <form autocomplete="off" class="form-group mt-4" action="{{route('tim-kiem')}}" method="GET">
                    @csrf
                    <div class="autocomplete input-group mx-auto">
                        <div class="row">
                            <input id="myInput" name="myInput" type="text" name="myCountry"
                                placeholder="Nhập tên khách sạn cần tìm ..." aria-label="Search" style="height: 50px;" required>

                            <div class="input-group-append" style="background: #f1f1f1;height: 50px;">
                                <button type="submit" id="myBtn" class="btn btn-navbar">
                                    <i class="fas fa-search"></i> Tìm kiếm
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- js map -->
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
        document.getElementById("mapid1").onclick = function () {
            $('#test').modal('show');
            setTimeout(function() {
                mymap.invalidateSize(false);
            }, 100);
        }

        document.getElementById("closebutton").onclick = function () {
            $('#test').modal('hide');
        }
        var json_DuLichpoint1={
            "type": "FeatureCollection",
            "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },

            "features": [
                @foreach($datadl as $x)
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
                @endforeach
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

                layer.bindTooltip('<div class="container-fluid"><div><img src="'+feature.properties.img+'"style="width:100%;height:200px"></div><div class="text-center"><h4>'+feature.properties.tendiadiem+'</h4></div><div class="row"><label class="col-form-label font-weight-bold"><i class="fa fa-location-arrow" aria-hidden="true"></i>: '+feature.properties.diachi+'</label></div></div>');
                layer.on('click', function(e) {
                    window.location = "http://localhost:8080/DoAnTotNghiep/public/"+feature.properties.url;
                });
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
                layer.bindTooltip('<div class="container-fluid"><div><img src="'+feature.properties.img+'"style="width:275px;height:200px"></div><div class="text-center"><h4>'+feature.properties.tenkhachsan +'<div class="hotel-rating"><span class="text-star"><i class="number"> '+feature.properties.sao +' sao </i></span><span class="bg-star">@for($i='+feature.properties.sao+';$i>1;$i--)<i class="fa fa-star"></i>@endfor</span></div></h4></div><div class="row"><label class="col-form-label font-weight-bold"><i class="fa fa-location-arrow" aria-hidden="true"></i>: '+feature.properties.diachi+'</label></div></div>');
                layer.on('click', function(e) {
                    window.location = "http://localhost:8080/DoAnTotNghiep/public/"+feature.properties.link;
                });
                
            },
            }).addTo(mymap);
    </script>
    <script src="{{asset('/js/geojsondata.js')}}"></script>
    <script src="{{asset('/js/geojson.js')}}"></script>
    <div class="row">
        <div class="col-3 float-left p-2">
            <form action="{{route('tim-kiem-nang-cao')}}">
                <div class="title_search">
                    <h3>Tìm kiếm chi tiết</h3>
                </div>
                <div class="row" style="border: 1px solid;background: #f1f1f1;">
                    <!-- <div class="form-group col-12">
                        <label class="col-form-label font-weight-bold">Mức giá</label>
                        <select name="mucgia" class="form-control">
                            <option value="" selected disabled hidden>-- Chọn --</option>
                            <option value="1">Dưới 500.000đ</option>
                            <option value="2">500.000đ - 2.000.000đ</option>
                            <option value="3">Trên 2.000.000đ</option>
                        </select>
                    </div> -->
                    <div class="form-group col-12">
                        <label class="col-form-label font-weight-bold">Xếp hạng khách sạn</label>
                        <select name="xephang" class="form-control">
                            @if (session()->has('timkiemnangcao') && $xephang != "")
                            <option value="{{$xephang}}" selected hidden>{{$xephang}} sao</option>
                            @else
                            <option value="" selected hidden>-- Chọn --</option>
                            @endif
                            <option value="5">5 sao</option>
                            <option value="4">4 sao</option>
                            <option value="3">3 sao</option>
                            <option value="2">2 sao</option>
                            <option value="1">1 sao</option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label class="col-form-label font-weight-bold">Khu vực</label>
                        <select name="khuvuc" class="form-control">
                            @if (session()->has('timkiemnangcao') && $datakhuvuc != "")
                                <option value="{{$datakhuvuc->gid}}" selected hidden>{{$datakhuvuc->ten}}</option>
                            @else
                                <option value="" selected hidden>-- Chọn --</option>
                            @endif
                            @foreach($dshuyenxa as $dtt)
                             <option value="{{$dtt->gid}}">{{$dtt->ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <button class="btn btn-info mt-4" style="width:100%;" type="submit">
                            <i class="fa fa-filter" aria-hidden="true"></i> Lọc
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-9 float-right p-2">
            <section class="prdList">
            @if (session()->has('timkiem'))
                <?php $tk = count($datatimkiem)?>
                <h3>Có {{$tk}} kết quả phù hợp</h3>
                <br>
                @foreach($datatimkiem as $dttk)
                <div class="prdItem">
                    <div class="prd-top">
                        <div class="itemImage">
                            <a target="_blank"
                                href="khach-san/{{$dttk->tenlink}}">
                                <img src="{{$dttk->img}}" alt="Khách sạn {{$dttk->tenkhachsan}}" style="height: 190px;width: 190px;">
                            </a>
                        </div>
                        <div class="itemContent">
                            <div class="itemInfo">
                                <div class="info-name">
                                    <h2>
                                        <a target="_blank"
                                            href="{{$dttk->tenlink}}">
                                            {{$dttk->tenkhachsan}}
                                        </a>
                                    </h2>
                                    <div class="hotel-rating hidden-xs">
                                        <span class="text-start"><i class="number"> {{$dttk->sao}} sao </i></span>
                                        <span class="bg-star">
                                            @if($dttk->sao == 1)
                                            <i class="fa fa-star"></i>
                                            @elseif($dttk->sao == 2)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>            
                                            @elseif($dttk->sao == 3)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            @elseif($dttk->sao == 4)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            @else
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>   
                                            @endif
                                        </span>
                                    </div>
                                    <div class="prAddress hidden-xs">
                                        <i class="fa fa-map-marker"></i>
                                        <p>{{$dttk->diachi}}
                                            
                                        </p>
                                        
                                    </div>
                                    <span class="pl-3"><a class="a-map-hotel" target="_blank" href="khach-san/{{$dttk->tenlink}}">(Xem chi tiết)</a></span>
                                </div>
                            </div>

                            <!-- this template to show price -->

                            <div class="itemPrice itemPrice_end">
                                <div class="itemPrice__content needsclick">
                                    <div class="iPrice">
                                        <p class="price-number">         
                                        Giá: <?php echo number_format($dttk->giaphong, 0, '', ',');?>₫   
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end item content -->
                    </div>
                </div>
                @endforeach
            </section>
            <section id="pagingPage" class="text-center">
                {{ $datatimkiem->links() }}
            </section>
            @elseif (session()->has('timkiemnangcao'))
                <?php $tknc = count($datanangcao)?>
                <h3>Có {{$tknc}} kết quả phù hợp</h3>
                <br>
                @foreach($datanangcao as $dttknc)
                <div class="prdItem">
                    <div class="prd-top">
                        <div class="itemImage">
                            <a target="_blank"
                                href="khach-san/{{$dttknc->tenlink}}">
                                <img src="{{$dttknc->img}}" alt="Khách sạn {{$dttknc->tenkhachsan}}" style="height: 190px;width: 190px;">
                            </a>
                        </div>
                        <div class="itemContent">
                            <div class="itemInfo">
                                <div class="info-name">
                                    <h2>
                                        <a target="_blank"
                                            href="{{$dttknc->tenlink}}">
                                            {{$dttknc->tenkhachsan}}
                                        </a>
                                    </h2>
                                    <div class="hotel-rating hidden-xs">
                                        <span class="text-start"><i class="number"> {{$dttknc->sao}} sao </i></span>
                                        <span class="bg-star">
                                            @if($dttknc->sao == 1)
                                            <i class="fa fa-star"></i>
                                            @elseif($dttknc->sao == 2)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>            
                                            @elseif($dttknc->sao == 3)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            @elseif($dttknc->sao == 4)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            @else
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>   
                                            @endif
                                        </span>
                                    </div>
                                    <div class="prAddress hidden-xs">
                                        <i class="fa fa-map-marker"></i>
                                        <p>{{$dttknc->diachi}}
                                            
                                        </p>
                                        
                                    </div>
                                    <span class="pl-3"><a class="a-map-hotel" target="_blank" href="khach-san/{{$dttknc->tenlink}}">(Xem chi tiết)</a></span>
                                </div>
                            </div>

                            <!-- this template to show price -->

                            <div class="itemPrice itemPrice_end">
                                <div class="itemPrice__content needsclick">
                                    <div class="iPrice">
                                        <p class="price-number">         
                                        Giá: <?php echo number_format($dttknc->giaphong, 0, '', ',');?>₫   
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end item content -->
                    </div>
                </div>
                @endforeach
            </section>
            <section id="pagingPage" class="text-center">
                {{ $datanangcao->links() }}
            </section>
            @else
                @foreach($data as $dt)
                <div class="prdItem">
                    <div class="prd-top">
                        <div class="itemImage">
                            <a target="_blank"
                                href="khach-san/{{$dt->tenlink}}">
                                <img src="{{$dt->img}}" alt="Khách sạn {{$dt->tenkhachsan}}" style="height: 190px;width: 190px;">
                            </a>
                        </div>
                        <div class="itemContent">
                            <div class="itemInfo">
                                <div class="info-name">
                                    <h2>
                                        <a target="_blank"
                                            href="{{$dt->tenlink}}">
                                            {{$dt->tenkhachsan}}
                                        </a>
                                    </h2>
                                    <div class="hotel-rating hidden-xs">
                                        <span class="text-start"><i class="number"> {{$dt->sao}} sao </i></span>
                                        <span class="bg-star">
                                            @if($dt->sao == 1)
                                            <i class="fa fa-star"></i>
                                            @elseif($dt->sao == 2)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>            
                                            @elseif($dt->sao == 3)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            @elseif($dt->sao == 4)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            @else
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>   
                                            @endif
                                        </span>
                                    </div>
                                    <div class="prAddress hidden-xs">
                                        <i class="fa fa-map-marker"></i>
                                        <p>{{$dt->diachi}}
                                            
                                        </p>
                                        
                                    </div>
                                    <span class="pl-3"><a class="a-map-hotel" target="_blank" href="khach-san/{{$dt->tenlink}}">(Xem chi tiết)</a></span>
                                </div>
                            </div>

                            <!-- this template to show price -->

                            <div class="itemPrice itemPrice_end">
                                <div class="itemPrice__content needsclick">
                                    <div class="iPrice">
                                        <p class="price-number">         
                                            Giá: <?php echo number_format($dt->giaphong, 0, '', ',');?>₫   
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end item content -->
                    </div>
                </div>
                @endforeach
            </section>
            <section id="pagingPage" class="text-center">
                {{ $data->links() }}
            </section>
            @endif
        </div>
    </div>
</div>
<script>
    // data for autocomplete
    var countries = [
                        @foreach($dataks as $ks)
                        "{{$ks->tenkhachsan}}",
                        @endforeach          
                    ];
        console.log(countries);
</script>
<script src="{{asset('/user/js/trangchu_autocomplete.js')}}"></script>
<script>
    autocomplete(document.getElementById("myInput"), countries);
</script>
@endsection