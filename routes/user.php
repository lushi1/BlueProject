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
// Route::get('/', function () {
//     return view('pages.admin.qltaikhoan');
// });
Route::get('/', 'QLTaiKhoan@DanhSachTK')->name('danhsachTK');

Route::get('/trangdangnhap', function () {
    return view('pages.dangnhap');
});
Route::get('/trangdangky', function () {
    return view('pages.dangky');
});

Route::get('/dangnhap','DangNhapDangKy@DangNhap')->name('dangnhap');

Route::get('danhsachSV', 'QLTaiKhoan@DanhsachSV')->name('danhsachSV');

Route::get('auth/google', 'LoginGoogleAccount@redirectToGoogle');
Route::get('auth/google/callback', 'LoginGoogleAccount@handleGoogleCallback');