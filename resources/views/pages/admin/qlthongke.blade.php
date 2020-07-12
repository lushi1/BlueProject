@extends('layouts.master-admin')
@section('content')
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content ">
        <!-- Noi dung -->
        <div class="row mb-3"></div>
        <div class="card">
            <div class="card-header">
                <div class="row float-left" style="font-size: 20px;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Thống kê</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- <div class="table table-reponsive"> -->
            <div class="card-body">
                <form action="{{route('thong-ke-chi-tiet')}}" method="POST">
                @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Loại thống kê</label>
                            <select name="loaithongke" id="loaithongke" class="form-control">
                            <option value="0" selected hidden>Khách sạn</option>
                                <option value="0">Khách sạn</option>
                                <option value="1">Điểm du lịch</option>
                            </select>
                        </div>              
                        <div class="form-group col-md-4">
                            <label>Yêu cầu</label>
                            <select name="loaiyeucau" class="form-control">
                            <option value="0" selected hidden>Theo vùng</option>
                                <option value="0">Theo vùng</option>
                                <option value="1">Theo chất lượng</option>
                            </select>
                        </div>          
                        <div class="form-group col-md-2">
                            <button class="btn-success form-control m-4" type="submit">Thống kê</button>
                        </div>       
                    </div>
                </form>
                @if(session()->has('check'))
                    <div class="row table-responsive mx-auto" style="font-size: 16px">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên vùng</th>
                                    @if(session()->has('check1'))
                                    <th scope="col">Số lượng khách sạn</th>
                                    @else
                                    <th scope="col">Số lượng điểm du lịch</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=1 ?>
                            @foreach($ds as $dt)
                                <tr>
                                    <th>{{$i++}}</th>
                                    <td>{{$dt->ten}}</td>
                                    <td>{{$dt->count}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif 
            </div>
        </div>
    </div>
</div>
@endsection