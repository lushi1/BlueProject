@extends('layouts.master-user')
@section('content')
<div class="img-banner">
    <img src="{{asset('/tp-moi.jpg')}}" alt="Banner">
    <div class="text-banner text-center">
        <h1 class="heading1">{{$ds->tieude}}</h1>
        <div class="d-flex">
            <div class="item col-4">
                <h4>{{$ds->tentaikhoan}}</h4>
            </div>
            <div class="item col-4">
                <h4>{{$ds->ngaytao}}</h4>
            </div>
            <div class="item col-4">
                <h4>{{$ds->view}} <i class="fa fa-eye" aria-hidden="true"></i></h4>
            </div>
        </div>
    </div>
</div>
<div class="wrap-content container">
    <div class="row">
        <div class="content-left col-8 float-left">
            {!! $ds->noidung !!}         
        </div>
        <div class="content-right col-4 float-right">
            <div class="box-shadow">      
                <h3>Nội dung chính</h3>
                <ul>
                    <li><a href="#gioi_thieu_binh_duong">Giới thiệu Bình Dương</a></li>
                    <li><a href="#cac_dia_diem_du_lich">Các địa điểm du lịch</a>
                        <ul>
                            @foreach($dsdiadiemdl as $dt)
                                <li><a href="#{{$dt->tenlink}}">{{$dt->tendiadiem}}</a></li>
                            @endforeach
                        </ul>
                    </li>               
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection