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
        <div class="content-left col-8 float-left">
            {!! $data->noidung !!}

            <hr/>
            <h3>Bạn có thể quan tâm</h3>
            <ul>
                <li><a href="#">Khám phá khu du lịch sinh thái Thủy Châu</a></li>
                <li><a href="#">Chùa Tây Tạng - ngôi chùa nổi tiếng nhất Bình Dương</a>
                </li>               
            </ul>          
        </div>
        <div class="content-left col-4 float-right">
            <h3>Các bài viết tương tự</h3> 
            <ul>
                <li><a href="#">Khám phá khu du lịch sinh thái Thủy Châu</a></li>
                <li><a href="#">Chùa Tây Tạng - ngôi chùa nổi tiếng nhất Bình Dương</a></li>               
            </ul>
        </div>
</div>
@endsection