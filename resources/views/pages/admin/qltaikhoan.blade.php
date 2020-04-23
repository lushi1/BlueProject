@extends('layouts.master-admin')
@section('content')
<link rel="stylesheet" href="{{asset('/admin/css/qltk.css')}}">
<div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- Noi dung -->

                    <div class="row mb-3"></div>
                    <div class="card">
                        <div class="card-header">
                            <div class="row float-left" style="font-size: 20px;">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a class="text-primary" href="trang-quan-tri">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Quản lý tài khoản</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="row float-right bg-success mr-3 mt-2">
                                <button class="btn btn-success" data-toggle="modal" data-target="#addModal"><i
                                        class="fa fa-plus"></i> Thêm</button>
                                <!-- Modal thêm -->
                                <form action="themTK" method="POST">
                                    @csrf
                                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog"
                                        aria-labelledby="addModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="modal-title" id="addModalLabel">Thêm Tài Khoản</h3>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="form-group col-6">
                                                            <label class="col-form-label font-weight-bold">Tên tài khoản<span class="text-danger"> (*)</span></label>
                                                            <input type="text" class="form-control" name="email">
                                                        </div>

                                                        <div class="form-group col-6">
                                                            <label class="col-form-label font-weight-bold">Loại tài khoản<span class="text-danger"> (*)</span></label>
                                                            <select name="loaitaikhoan" class="form-control">
                                                            <option value="0" selected hidden>Admin</option>
                                                            @foreach($dsloaitk as $dsltk)
                                                                <option value="{{$dsltk->id}}">{{$dsltk->loaitaikhoan}}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-6">
                                                            <label class="col-form-label font-weight-bold">Mật khẩu<span class="text-danger"> (*)</span></label>
                                                            <input type="password" class="form-control" name="matkhau">
                                                        </div>
                                                        <?php //Hiển thị thông báo lỗi?>
                                                        @if ( Session::has('error') )
                                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                                            <strong>{{ Session::get('error') }}</strong>
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                <span class="sr-only">Close</span>
                                                            </button>
                                                        </div>
                                                        @endif
                                                        <div class="form-group col-6">
                                                            <label class="col-form-label font-weight-bold">Xác nhận Mật khẩu<span class="text-danger"> (*)</span></label>
                                                            <input type="password" class="form-control" name="xacnhanmatkhau">
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Thêm</button>
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Đóng</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                    <!-- End modal thêm -->
                            </div>

                            <!-- Search bar -->

                            <div class="navbar-nav col-3 float-right mr-3 mt-2">
                                        <div id="custom-search" class="top-search-bar">
                                            <input class="form-control" type="text" placeholder="Search..">

                                        </div>
                            </div>

                            <!-- End search bar -->

                        </div>



                      
                        <!-- <div class="table table-reponsive"> -->
                        <div class="card-body">
                            <div class="row table-responsive mx-auto" style="font-size: 16px">
                                <table class="table table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tên tài khoản</th>
                                            <th scope="col">Quyền</th>
                                            <th scope="col">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1 ?>
                                    @foreach($dstaikhoan as $tk)
                                    <?php
                                        $sua = "sua".$tk->id;
                                        $xoa = "xoa".$tk->id; ?>
                                        <tr>
                                            <th>{{$i++}}</th>
                                            <td>{{$tk->tentaikhoan}}</td>
                                            <td>{{$tk->loaitaikhoan===0 ? 'Admin' : 'Khách hàng'}}</td>
                                            <td>
                                               
                                                <span data-toggle="modal" data-target="#{{$xoa}}">
                                                    <a href="#" class="text-danger ml-3" data-toggle="tooltip"
                                                        data-placement="right" data-html="true" title="Xóa"><i
                                                            class="fa fa-trash-alt fa-lg"></i></a>
                                                </span>
                                               
                                                <!-- Modal xóa -->
                                                <form action="{{route('xoaTK',['id' => $tk->id])}}"
                                                            method="post">
                                                @csrf
                                                <div class="modal fade" id="{{$xoa}}" tabindex="-1" role="dialog"
                                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h2 class="modal-title" id="deleteModalLabel">Xóa Tài Khoản</h3>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <h5>Bạn có chắc muốn xóa tài khoản <span>"{{$tk->tentaikhoan}}"</span></h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                                                <button type="button" class="btn btn-default float-left"
                                                                    data-dismiss="modal">Hủy</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                                <!-- End modal xóa -->

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
@endsection