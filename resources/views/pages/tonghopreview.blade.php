@extends('layouts.master-user')
@section('content')

<div class="img-banner">
    <img src="{{asset('/tp-moi.jpg')}}" alt="Banner">
    <div class="text-banner">
        <h1 class="heading1">{{$dsbaiviet->tieude}}</h1>
        <div class="d-flex">
            <div class="item col-4">
                <h4>Nam Lê 20/12/20202</h4>
            </div>
            <div class="item col-4">
                <h4>Du lịch Bình Dương</h4>
            </div>
            <div class="item col-4">
                <h4>100030 lượt xem</h4>
            </div>
        </div>
    </div>
</div>
<div class="wrap-content container">
        <div class="content-left col-8 float-left">
            {!! $dsbaiviet->noidung !!}
            <!-- <p>Bạn chưa bao giờ đặt cái tên Bình Dương vào trong list những điểm du lịch ở Việt Nam 
            nhất định phải đến? Bạn từng nhiều lần từ chối cơ hội du lịch Bình Dương vì nghĩ vùng đất này 
            chỉ gắn liền với các khu công nghiệp xa xôi? Vậy thì bài viết này có thể sẽ làm thay đổi suy 
            nghĩ và có thể Bình Dương sẽ là cái tên xuất hiện trong danh sách các điểm du lịch sắp tới của 
            bạn.</p>
            <br/>
            <h3>I. Giới thiệu Bình Dương</h3>
            <p>Bình Dương là một tỉnh thuộc khu vực Đông Nam Bộ, cách 30 km từ trung tâm thành phố Hồ Chí Minh
             và nằm trong top 7 tỉnh có dân số đông nhất Việt Nam. Nơi đây được biết đến là “xứ sở của những cơn 
             mưa”. Vào những tháng đầu mùa mưa thường có mưa rào rất lớn, đặc biệt, từ tháng 7 tới tháng 9 là 
             khoảng thời gian xuất hiện những cơn mưa dầm kéo dài 1-2 ngày mới chịu dứt. Tuy nhiên bù lại, Bình 
             Dương được thiên nhiên ưu ái ban cho thảm thực vật vô cùng phong phú và những tài nguyên khoáng sản 
             có giá trị.</p>
            <h3>II. Các địa điểm du lịch</h3> -->
        </div>
        <div class="content-right col-4 float-right">
            <h3>Nội dung chính</h3>
            <ul>
                <li><a href="#">Giới thiệu Bình Dương</a></li>
                <li><a href="#">Các địa điểm du lịch</a>
                    <ul>
                        <li><a href="#">title1</a></li>
                        <li><a href="#">title2</a></li>
                    </ul>
                </li>               
            </ul>
        </div>
</div>

@endsection