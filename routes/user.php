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

Route::get('/', 'QLTaiKhoan@DanhSachTK')->name('danhsachTK');

Route::get('/trangdangnhap','DangNhapDangKy@TrangDangNhap')->name('dangnhap');
// Route::get('/trangdangky',function(){
//     return view('pages.dangky');
// });

// Route::post('/dangky','DangNhapDangKy@DangKy')->name('dangky');

Route::get('/dangnhap','DangNhapDangKy@DangNhap')->name('dangnhap');
Route::get('auth/google', 'LoginGoogleAccount@redirectToGoogle');
Route::get('auth/google/callback', 'LoginGoogleAccount@handleGoogleCallback');

Route::get('/trang-chu','QLTrangChu@TrangChu')->name('trang-chu');