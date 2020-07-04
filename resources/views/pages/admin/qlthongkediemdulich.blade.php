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
                                        <li class="breadcrumb-item"><a class="text-primary" href="trang-quan-tri">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Thống kê điểm du lịch</li>
                                    </ol>
                                </nav>
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
                                            <th scope="col">Tên vùng</th>
                                            <th scope="col">Số lượng khách sạn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1 ?>
                                    @foreach($dshuyenxa as $huyenxa)
                                    <?php $count = 0?>
                                        <tr>
                                            <th scope="row">{{$i++ + ($dshuyenxa->currentPage() -1)* $pageSize }}</th>
                                            <td>{{$huyenxa->ten}}</td>
                                            <?php
                                                foreach($dsdiemdulich as $diemdulich)
                                                {
                                                    if($diemdulich->idvung == $huyenxa->gid)
                                                        $count++;
                                                }
                                                ?>
                                            <td>{{$count}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content mt-4">
                                {{ $dshuyenxa->links() }}

                            </div>

                        </div>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
@endsection