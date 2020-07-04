@extends('layouts.master-user')
@section('content')

<div class="contentPage container">
    <div class="breadcrumb-div mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="#">Khách sạn</a></li>
                <li class="breadcrumb-item active" aria-current="page">Khách sạn Sơn Thủy 2</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="detail-title">
                <h3>Khách sạn Sơn Thủy 2
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
    <div class="m-4">
        <div class="row"> 
            <div class="col-4">
                <img src=" https://statics2.vntrip.vn/564x310/data-v2/hotels/9286/img_max/9286_1568883923_20286e012a1ecd40940f.jpg " width="100%" height="200px"/>
            </div>
            <div class="col-4">
                <img src=" https://statics2.vntrip.vn/564x310/data-v2/hotels/9286/img_max/9286_1568883923_20286e012a1ecd40940f.jpg " width="100%" height="200px"/>
            </div>
            <div class="col-4">
                <img src=" https://statics2.vntrip.vn/564x310/data-v2/hotels/9286/img_max/9286_1568883923_20286e012a1ecd40940f.jpg " width="100%" height="200px"/>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-4">
                <img src=" https://statics2.vntrip.vn/564x310/data-v2/hotels/9286/img_max/9286_1568883923_20286e012a1ecd40940f.jpg " width="100%" height="200px"/>
            </div>
            <div class="col-4">
                <img src=" https://statics2.vntrip.vn/564x310/data-v2/hotels/9286/img_max/9286_1568883923_20286e012a1ecd40940f.jpg " width="100%" height="200px"/>
            </div>
            <div class="col-4">
                <img src=" https://statics2.vntrip.vn/564x310/data-v2/hotels/9286/img_max/9286_1568883923_20286e012a1ecd40940f.jpg " width="100%" height="200px"/>
            </div>
        </div>
    </div>
</div>

@endsection