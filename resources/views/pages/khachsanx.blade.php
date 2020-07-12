@extends('layouts.master-user')
@section('content')
@foreach($data as $dt)
<link rel="stylesheet" href="{{asset('/user/css/chitietkhachsan.css')}}">
<div class="contentPage container">
    <div class="breadcrumb-div mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="#">Khách sạn</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$dt->tenkhachsan}}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="detail-title">
                <h3>{{$dt->tenkhachsan}}
                    <div class="hotel-rating">
                        <span class="text-star">
                            <i class="number"> {{$dt->sao}} sao </i>
                        </span>
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
                </h3>
            </div>
            <p class="hotel-info hidden-xs">
                <img src="https://statics.vntrip.vn/website/images/province.png" alt="">
                <span class="address">{{$dt->diachi}}</span>
                <span class="tripad-rating"></span>
            </p>
        </div>
    </div>
    <div class="img-common-place m-3">
        <div class="row m-3">
            @foreach($data1 as $ds)
                <div class="img-div float-left col-4" style="padding-bottom: 20px;">
                    <img src="/editor/ckfinder/userfiles/images/{{$ds->img}}" alt="img">            
                </div>
            @endforeach
            <div class="img-div float-left col-4" id="mapid1">
                <img src="{{asset('/google-maps.jpg')}}" alt="img">
            </div>
            <!-- Modal map -->
            
                <div class="modal" id="test" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header mt-3">                     
                                    <div class="col-5">
                                        <h5 class="modal-title" id="exampleModalLabel">Bản đồ</h5>
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
        </div>
    </div>
    
        {!!$dt->noidung!!}
        <!-- <section class="detail-hotel-info row">
        <div class="hotel-info-title hidden-xs">
            <h3>Thông tin về khách sạn New Hotel Bình Dương 1</h3>
        </div>
        <hr/>
        <div class="hotel-info-content">
            <div class="info-content-description">
                <div class="content-description-title col-3 float-left"><span><h4>Mô tả</h4></span></div>
                <div class="content-description col-9 float-right">
                    <p class="short" style="display: block;">Khách sạn New Hotel Bình Dương 1 - ngay trung tâm thành phố
                    <p class="full" style="display: none;">
                        <h2 ,=""><strong>Khách sạn New Hotel Bình Dương 1 - ngay trung tâm thành phố</strong></h2>
                        <br>
                        <h3><strong>Địa chỉ khách sạn New Hotel Bình Dương 1:</strong></h3>
                        <p>23 Phan Như Thạch, Thành Phố Đà Lạt, Lâm Đồng</p>
                        <br><h3><strong>Vị trí địa lý:</strong></h3>
                        <p><strong>Khách sạn New Hotel Bình Dương 1</strong> tọa lạc tại số 23 Phan Như Thạch một trong 2 con đường nhiều khách sạn nhất Đà Lạt hiện nay. Vị trí khách sạn nằm ngay tại trung tâm thành phố cách chợ Đà Lạt chỉ 5 phút đi bộ, cho phép du khách thoải mái tham quan các địa danh cũng như khu mua sắm của thành phố mà không mất quá nhiều thời gian đi lại. <br><br><h3><strong>Đặc điểm&nbsp;khách sạn:</strong></h3><br><br><p><strong>Khách sạn New Hotel Bình Dương 1</strong> là khách sạn tiêu chuẩn 2 sao với thiết kế theo phong cách hiện đại làm nổi bật sự sang trọng và tinh tế. Mỗi phòng nghỉ đều có hệ thống cửa sổ lấy ánh sáng tự nhiên ở khắp nơi giúp bạn có một không gian nghỉ mát tuyệt vời với không khí trong lành và ánh sáng mặt trời tự nhiên. <strong>New Hotel Bình Dương 1</strong> hứa hẹn mang tới cho du khách một không gian nghỉ ngơi trong lành và thư thái.</p><br><br><h3><strong>Dịch vụ&nbsp;khách sạn:</strong></h3><br><br><p>Để đảm bảo sự thoải mái và vui vẻ của quý khách khi lưu trú tại khách sạn, <strong>New Hotel Bình Dương 1</strong> được trang bị 24 phòng nghỉ với các hạng phòng khác nhau, đảm bảo đáp ứng nhu cầu nghỉ ngơi của tất cả các đối tượng khách hàng. Đặc biệt, mỗi phòng khách sạn đều được trang bị đầy đủ các trang thiết bị hiện đại như Tivi 42 inch, tủ lạnh, phòng tắm riêng với bồn tắm/vòi sen, dép đi trong nhà, đồ vệ sinh cá nhân miễn phí và máy sấy tóc nhằm mang lại sự thoải mái cho khách.</p><br><br><p><strong>Khách sạn New Hotel Bình Dương 1</strong> cung cấp các dịch vụ chất lượng cao như dịch vụ đưa đón sân bay, dịch vụ lễ tân 24 giờ, bàn bán tour, dịch vụ cho thuê xe đạp,... Ngoài ra, <strong>khách sạn New Hotel Bình Dương 1</strong> còn có bãi đổ xe cho tất cả các loại xe từ 4 - 45 chỗ ngồi ngay bên cạnh khách sạn, đây là một lợi thế mà không nhiều khách sạn tại Đà Lạt có được. </p><br><br><h3><strong>Địa điểm du lịch hút khách tại Quy Nhơn:</strong></h3><br><br><p><strong>New Hotel Bình Dương 1</strong> cách Hồ Xuân Hương 1,3 km và Vườn hoa Đà Lạt 2 km. Sân bay gần nhất là sân bay Liên Khương, cách đó 22 km.</p></p></p>
                </div>
            </div>
            <div class="info-content-description">
                <div class="content-description-title col-3 float-left"><span>Đặc trưng</span>
                </div>
                <div class="content-description col-9 float-right">
                    <div class="feature-categories"><p><strong>Phương tiện đi lại</strong></p><div class="row"><div class="col-lg-4"><p><i class="fa fa-check"></i>Dịch vụ Taxi</p></div><div class="col-lg-4"><p><i class="fa fa-check"></i>Xe hơi</p></div></div></div><div class="feature-categories"><p><strong>Internet</strong></p><div class="row"><div class="col-lg-4"><p><i class="fa fa-check"></i>Miễn phí Wifi trong phòng</p></div><div class="col-lg-4"><p><i class="fa fa-check"></i>Miễn phí WIfi ở tất cả các khu vực</p></div></div></div><div class="feature-categories"><p><strong>Ngôn ngữ sử dụng</strong></p><div class="row"><div class="col-lg-4"><p><i class="fa fa-check"></i>Tiếng Anh</p></div><div class="col-lg-4"><p><i class="fa fa-check"></i>Tiếng Việt</p></div></div></div><div class="feature-categories"><p><strong>Dịch vụ lễ tân</strong></p><div class="row"><div class="col-lg-4"><p><i class="fa fa-check"></i>Lễ tân 24 giờ</p></div><div class="col-lg-4"><p><i class="fa fa-check"></i>An ninh 24 giờ</p></div><div class="col-lg-4"><p><i class="fa fa-check"></i>Dịch vụ báo thức</p></div><div class="col-lg-4"><p><i class="fa fa-check"></i>Dịch vụ đặt vé</p></div><div class="col-lg-4"><p><i class="fa fa-check"></i>Bàn Tour</p></div><div class="col-lg-4"><p><i class="fa fa-check"></i>Bãi đậu xe</p></div><div class="col-lg-4"><p><i class="fa fa-check"></i>Dịch vụ giữ hành lý</p></div><div class="col-lg-4"><p><i class="fa fa-check"></i>Tủ khóa</p></div><div class="col-lg-4"><p><i class="fa fa-check"></i>Két sắt</p></div></div></div><div class="feature-categories"><p><strong>Khu vực chung</strong></p><div class="row"><div class="col-lg-4"><p><i class="fa fa-check"></i>Sân</p></div></div></div><div class="feature-categories"><p><strong>Dịch vụ lau dọn</strong></p><div class="row"><div class="col-lg-4"><p><i class="fa fa-check"></i>Giặt khô</p></div><div class="col-lg-4"><p><i class="fa fa-check"></i>Giặt ủi</p></div><div class="col-lg-4"><p><i class="fa fa-check"></i>Phục vụ phòng hằng ngày</p></div></div></div><div class="feature-categories"><p><strong>Dịch vụ khác</strong></p><div class="row"><div class="col-lg-4"><p><i class="fa fa-check"></i>Khu vực cho phép hút thuốc</p></div><div class="col-lg-4"><p><i class="fa fa-check"></i>Phòng không hút thuốc</p></div><div class="col-lg-4"><p><i class="fa fa-check"></i>Tiện nghi dành cho người khuyết tật</p></div><div class="col-lg-4"><p><i class="fa fa-check"></i>Thang máy</p></div><div class="col-lg-4"><p><i class="fa fa-check"></i>Phòng gia đình</p></div></div></div>
                </div>
            </div>
            <div class="info-content-description">
                <div class="content-description-title col-3 float-left"><span>Thông tin cần biết</span>
                </div>
                <div class="content-description col-9 float-right">
                    <p><strong>Nhận phòng/ Trả phòng</strong></p>
                    <div class="necessary-in-out">
                        <p>Nhận phòng từ:</p>
                        <p>Trả phòng đến:</p>
                    </div>
                    <div class="necessary-time">
                            <p>14:00:00</p>
                            <p>12:00:00</p> 
                    </div>
                    <p>Hủy đặt phòng/Trả trước</p>
                    <p class="necessary-in-out">Các loại phòng khác nhau có thể có chính sách hủy đặt phòng và chính sách thanh toán trước khác nhau. Vui lòng kiểm tra chi tiết chính sách phòng khi chọn phòng ở phía trên</p>
                </div>
            </div>
        </div>
    </section> -->
    
</div>
<script>
    var mymap = L.map('mapid').setView([{{$dt->st_y}},{{$dt->st_x}}], 16);
    var tileLayyer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibHVzaGkiLCJhIjoiY2s0YXFnNHRyMDY2dzNlbGtvM3pwcThhMyJ9.F9DH_aBnwZYWez_5hy3xNA', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    }).addTo(mymap);

    var khachsan_icon = L.icon({
        iconUrl: '{{asset('/hotel.png')}}',
        iconAnchor: [25, 41],
        iconSize: [30, 45],
    });

    var khachsan_marker = L.marker([{{$dt->st_y}},{{$dt->st_x}}], {icon: khachsan_icon}).addTo(mymap).bindPopup('<div class="container-fluid"><div><img src="{{$dt->img}}" style="width:275px;height:200px"></div><div class="text-center"><h4>{{$dt->tenkhachsan}}<div class="hotel-rating"><span class="text-star"><i class="number">{{$dt->sao}} sao </i></span></div></h4></div><div class="row"><label class="col-form-label font-weight-bold"><i class="fa fa-location-arrow" aria-hidden="true"></i>: {{$dt->diachi}}</label></div></div>');

    var json_DuLichpoint1={
        "type": "FeatureCollection",
        "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },

        "features": [
            @foreach($datadl as $dl)
                {
                    "type": "Feature",
                    "properties":
                    {
                        "id": {{$dl->gid}},
                        "diachi": "{{$dl->diachi}}",                                             
                        "tendiadiem": "{{$dl->tendiadiem}}",
                        "tenrutgon": "{{$dl->tenrutgon}}",
                        "xoa": "xoa{{$dl->gid}}",
                        "sua": "sua{{$dl->gid}}",
                        "img": "{{$dl->img}}",
                        "lng": {{$dl->st_x}},
                        "lat": {{$dl->st_y}},
                        "url": "danh-gia/{{$dl->tenlink}}",
                    },
                    "geometry":
                    {
                        "type": "Point",
                        "coordinates": [ {{$dl->st_x}}, {{$dl->st_y}} ],
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
            
        },

        }).addTo(mymap);
    
        var json_KhachSan={

            "type": "FeatureCollection",
            "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },

            "features": [
                            @foreach($dataks as $ks)
                                {
                                    "type": "Feature",
                                    "properties":
                                    {
                                        "id": {{$ks->gid}},
                                        "diachi": "{{$ks->diachi}}",
                                        "tenkhachsan": "{{$ks->tenkhachsan}}",
                                        "xoa": "xoa{{$ks->gid}}",
                                        "sua": "sua{{$ks->gid}}",
                                        "lng": {{$ks->st_x}},
                                        "lat": {{$ks->st_y}},
                                        "img": "{{$ks->img}}",
                                        "sao": "{{$ks->sao}}",
                                        "link": "khach-san/{{$ks->tenlink}}",
                                    },
                                    "geometry":
                                    {
                                        "type": "Point",
                                        "coordinates": [ {{$ks->st_x}}, {{$ks->st_y}} ],
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
                var star = parseInt(feature.properties.sao);
                layer.bindTooltip('<div class="container-fluid"><div><img src="'+feature.properties.img+'"style="width:275px;height:200px"></div><div class="text-center"><h4>'+feature.properties.tenkhachsan +'<div class="hotel-rating"><span class="text-star"><i class="number"> '+feature.properties.sao +' sao </i></span><span class="bg-star">@for($i='+feature.properties.sao+';$i>1;$i--)<i class="fa fa-star"></i>@endfor</span></div></h4></div><div class="row"><label class="col-form-label font-weight-bold"><i class="fa fa-location-arrow" aria-hidden="true"></i>: '+feature.properties.diachi+'</label></div></div>');       
            },

            filter: function(feature,layer)
            {
                if(feature.properties.lng != {{$dt->st_x}} && feature.properties.lng != {{$dt->st_x}})
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
</script>
<script src="{{asset('/js/geojsondata.js')}}"></script>
<script src="{{asset('/js/geojson.js')}}"></script>
@endforeach
@endsection