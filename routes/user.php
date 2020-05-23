<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','QLTrangChu@TrangChu')->name('trang-chu');

Route::get('/trang-dang-nhap','DangNhapDangKy@TrangDangNhap')->name('trang-dang-nhap');
// Route::get('/trangdangky',function(){
//     return view('pages.dangky');
// });

// Route::post('/dangky','DangNhapDangKy@DangKy')->name('dangky');

Route::get('/dang-nhap','DangNhapDangKy@DangNhap')->name('dang-nhap');
// Đăng nhập bằng tài khoản google
Route::get('auth/google', 'LoginGoogleAccount@redirectToGoogle');
Route::get('auth/google/callback', 'LoginGoogleAccount@handleGoogleCallback');

Route::get('/trang-chu','QLTrangChu@TrangChu')->name('trang-chu');

Route::get('/tong-hop-review','QLBaiViet@DanhSachRV')->name('tong-hop-review');

//test
Route::get('/test', function () {
    return view('test');
});