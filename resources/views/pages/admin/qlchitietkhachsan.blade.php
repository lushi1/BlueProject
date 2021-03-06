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
                                        <li class="breadcrumb-item active" aria-current="page">Quản lý chi tiết khách sạn</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="row float-right bg-success mr-3 mt-2">
                                <button class="btn btn-success" data-toggle="modal" data-target="#addModal"><i
                                        class="fa fa-plus"></i> Thêm</button>
                                <!-- Modal thêm -->
                                <form action="themCTKS" method="POST">
                                    @csrf
                                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog"
                                        aria-labelledby="addModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="modal-title" id="addModalLabel">Thêm Chi Tiết Khách Sạn</h3>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-6">
                                                            <label class="col-form-label font-weight-bold">Khách sạn<span class="text-danger"> (*)</span></label>
                                                            <select name="khachsan_id" class="form-control">
                                                            <option value="{{$data->gid}}" selected hidden>{{$data->tenkhachsan}}</option>
                                                            @foreach($dskhachsan as $dt)
                                                                <option value="{{$dt->gid}}">{{$dt->tenkhachsan}}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label class="col-form-label font-weight-bold">Nội dung<span class="text-danger"> (*)</span></label>
                                                            <div class="form-group col-12">
                                                                <textarea name="noidung" id="noidung" cols="30" rows="10"></textarea>
                                                                <script src={{ url('editor/ckeditor/ckeditor.js') }}></script>
                                                                <script>
                                                                CKEDITOR.replace( 'noidung');
                                                                // CKEDITOR.replace( 'text', {
                                                                    // filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
                                                                    // filebrowserBrowseUrl: '{{ asset('editor/ckfinder/ckfinder.html') }}',
                                                                    // filebrowserImageBrowseUrl: '{{ asset('editor/ckfinder/ckfinder.html?type=Images') }}',
                                                                    // filebrowserFlashBrowseUrl: '{{ asset('editor/ckfinder/ckfinder.html?type=Flash') }}',
                                                                    // filebrowserUploadUrl: '{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                                                                    // filebrowserImageUploadUrl: '{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                                                                    // filebrowserFlashUploadUrl: '{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
                                                                // } );
                                                                </script>
                                                            </div>
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
                                            <!-- <th scope="col">Nội dung</th> -->
                                            <th scope="col">Khách sạn</th>
                                            <th scope="col">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1 ?>
                                    @foreach($dsctkhachsan as $ds)
                                    <?php
                                        $sua = "sua".$ds->id;
                                        $xoa = "xoa".$ds->id; ?>
                                        <tr>
                                        <th scope="row">{{$i++ + ($dsctkhachsan->currentPage() -1)* $pageSize }}</th>                                      
                                            <!-- <td>{!! $ds->noidung !!}</td> -->
                                            <td>{{$ds->tenkhachsan}}</td>                                               
                                            <td>
                                                <span data-toggle="modal" data-target="#{{$sua}}">
                                                    <a href="#" class="text-success ml-3" data-toggle="tooltip"
                                                        data-placement="bottom" data-html="true" title="Sửa"><i
                                                            class="fa fa-edit fa-lg"></i></a>
                                                </span>

                                                <span data-toggle="modal" data-target="#{{$xoa}}">
                                                    <a href="#" class="text-danger ml-3" data-toggle="tooltip"
                                                        data-placement="right" data-html="true" title="Xóa"><i
                                                            class="fa fa-trash-alt fa-lg"></i></a>
                                                </span>
                                                
                                                <!-- Modal xóa -->
                                                <form action="{{route('xoaCTKS',['id' => $ds->id])}}"
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
                                                            <h5>Bạn có chắc muốn xóa chi tiết khách sạn <span>{{$ds->tenkhachsan}}</span></h5>
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

                                                <!-- Modal sửa -->
                                                <form action="{{route('suaCTKS',['id' => $ds->id])}}"
                                                            method="post">
                                                @csrf
                                                <div class="modal fade" id="{{$sua}}" tabindex="-1" role="dialog"
                                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h2 class="modal-title" id="editModalLabel">Sửa Bài Viết</h3>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <div class="row">
                                                        
                                                        <div class="form-group col-12">
                                                            <label class="col-form-label font-weight-bold">Nội dung<span class="text-danger"> (*)</span></label>
                                                            <div class="form-group col-12">
                                                                <textarea name="{{$sua}}{{$sua}}" id="{{$sua}}{{$sua}}" cols="30" rows="10" >{!!$ds->noidung!!}</textarea>
                                                                
                                                                <script>
                                                                CKEDITOR.replace( '{{$sua}}{{$sua}}');
                                                                // CKEDITOR.replace( 'text', {
                                                                    // filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
                                                                    // filebrowserBrowseUrl: '{{ asset('editor/ckfinder/ckfinder.html') }}',
                                                                    // filebrowserImageBrowseUrl: '{{ asset('editor/ckfinder/ckfinder.html?type=Images') }}',
                                                                    // filebrowserFlashBrowseUrl: '{{ asset('editor/ckfinder/ckfinder.html?type=Flash') }}',
                                                                    // filebrowserUploadUrl: '{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                                                                    // filebrowserImageUploadUrl: '{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                                                                    // filebrowserFlashUploadUrl: '{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
                                                                // } );
                                                                </script>
                                                            </div>
                                                        </div>

                                                    </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger">Sửa</button>
                                                                <button type="button" class="btn btn-default float-left"
                                                                    data-dismiss="modal">Hủy</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                                <!-- End modal sửa -->

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content mt-4">
                                {{ $dsctkhachsan->links() }}

                            </div>
                        </div>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
@endsection