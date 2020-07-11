@extends('layouts.master-user')
@section('content')
<link rel="stylesheet" href="{{asset('/user/css/chitietkhachsan.css')}}">
<div class="contentPage container">
    <div class="breadcrumb-div mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="#">Khách sạn</a></li>
                <li class="breadcrumb-item active" aria-current="page">Khách sạn The Mira Hotel</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="detail-title">
                <h3>Khách sạn The Mira Hotel
                    <div class="hotel-rating">
                        <span class="text-star">
                            <i class="number"> 2 sao </i>
                        </span>
                        <span class="bg-star">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                    </div>
                </h3>
            </div>
            <p class="hotel-info hidden-xs">
                <img src="https://statics.vntrip.vn/website/images/province.png" alt="">
                <span class="address">23 Phan Như Thạch, Thành Phố Đà Lạt, Lâm Đồng </span>
                <span class="tripad-rating"></span>
            </p>
        </div>
    </div>
    <div class="img-common-place m-3">
        <div class="row m-3">
            <div class="img-div float-left col-4">
                <img src="{{asset('the-mira-hotel-1.jpeg')}}" alt="img">
                
            </div>
            <div class="img-div float-left col-4">
                <img src="{{asset('the-mira-hotel-4.jpeg')}}" alt="img">
                
            </div>
            <div class="img-div float-left col-4">
                <img src="{{asset('the-mira-hotel-3.jpeg')}}" alt="img">
               
            </div>
        </div>
        <div class="row m-3">
            <div class="img-div float-left col-3">
                <img src="{{asset('the-mira-hotel-5.jpeg')}}" alt="img">
                
            </div>
            <div class="img-div float-left col-3">
                <img src="{{asset('the-mira-hotel-6.jpeg')}}" alt="img">
                
            </div>
            <div class="img-div float-left col-3">
                <img src="{{asset('the-mira-hotel-7.jpeg')}}" alt="img">
               
            </div>
            <div class="img-div float-left col-3">
                <img src="{{asset('/google-maps.jpg')}}" alt="img">
            </div>
        </div>
    </div>
    <section class="detail-hotel-info row">
        <div class="hotel-info-title hidden-xs">
            <h3>Thông tin về khách sạn The Mira Hotel</h3>
        </div>
        <hr/>
        <div class="hotel-info-content">
            <div class="info-content-description">
                <div class="content-description-title col-3 float-left"><span><h4>Mô tả</h4></span></div>
                <div class="content-description col-9 float-right">
                    <p class="short" style="display: block;">Khách sạn The Mira Hotel - ngay trung tâm thành phố
                    <p class="full" style="display: none;">
                        <h2 ,=""><strong>Khách sạn The Mira Hotel - ngay trung tâm thành phố</strong></h2>
                        <br>
                        <h3><strong>Địa chỉ khách sạn The Mira Hotel:</strong></h3>
                        <p>23 Phan Như Thạch, Thành Phố Đà Lạt, Lâm Đồng</p>
                        <br><h3><strong>Vị trí địa lý:</strong></h3>
                        <p><strong>Khách sạn The Mira Hotel</strong> tọa lạc tại số 23 Phan Như Thạch một trong 2 con đường nhiều khách sạn nhất Đà Lạt hiện nay. Vị trí khách sạn nằm ngay tại trung tâm thành phố cách chợ Đà Lạt chỉ 5 phút đi bộ, cho phép du khách thoải mái tham quan các địa danh cũng như khu mua sắm của thành phố mà không mất quá nhiều thời gian đi lại. <br><br><h3><strong>Đặc điểm&nbsp;khách sạn:</strong></h3><br><br><p><strong>Khách sạn The Mira Hotel</strong> là khách sạn tiêu chuẩn 2 sao với thiết kế theo phong cách hiện đại làm nổi bật sự sang trọng và tinh tế. Mỗi phòng nghỉ đều có hệ thống cửa sổ lấy ánh sáng tự nhiên ở khắp nơi giúp bạn có một không gian nghỉ mát tuyệt vời với không khí trong lành và ánh sáng mặt trời tự nhiên. <strong>The Mira Hotel</strong> hứa hẹn mang tới cho du khách một không gian nghỉ ngơi trong lành và thư thái.</p><br><br><h3><strong>Dịch vụ&nbsp;khách sạn:</strong></h3><br><br><p>Để đảm bảo sự thoải mái và vui vẻ của quý khách khi lưu trú tại khách sạn, <strong>The Mira Hotel</strong> được trang bị 24 phòng nghỉ với các hạng phòng khác nhau, đảm bảo đáp ứng nhu cầu nghỉ ngơi của tất cả các đối tượng khách hàng. Đặc biệt, mỗi phòng khách sạn đều được trang bị đầy đủ các trang thiết bị hiện đại như Tivi 42 inch, tủ lạnh, phòng tắm riêng với bồn tắm/vòi sen, dép đi trong nhà, đồ vệ sinh cá nhân miễn phí và máy sấy tóc nhằm mang lại sự thoải mái cho khách.</p><br><br><p><strong>Khách sạn The Mira Hotel</strong> cung cấp các dịch vụ chất lượng cao như dịch vụ đưa đón sân bay, dịch vụ lễ tân 24 giờ, bàn bán tour, dịch vụ cho thuê xe đạp,... Ngoài ra, <strong>khách sạn The Mira Hotel</strong> còn có bãi đổ xe cho tất cả các loại xe từ 4 - 45 chỗ ngồi ngay bên cạnh khách sạn, đây là một lợi thế mà không nhiều khách sạn tại Đà Lạt có được. </p><br><br><h3><strong>Địa điểm du lịch hút khách tại Quy Nhơn:</strong></h3><br><br><p><strong>The Mira Hotel</strong> cách Hồ Xuân Hương 1,3 km và Vườn hoa Đà Lạt 2 km. Sân bay gần nhất là sân bay Liên Khương, cách đó 22 km.</p></p></p>
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
    </section>
</div>

@endsection