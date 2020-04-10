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
// Quản lý tài khoản
Route::get('danhsachTK', 'QLTaiKhoan@DanhSachTK')->name('danhsachTK');
Route::post('themTK','QLTaiKhoan@ThemTK')->name('themTK');
Route::post('xoaTK/{id}','QLTaiKhoan@XoaTK')->name('xoaTK');

// Quản lý bài viết
Route::get('danhsachBV', 'QLBaiViet@DanhSachBV')->name('danhsachBV');
Route::post('themBV','QLBaiViet@ThemBV')->name('themBV');
Route::post('xoaBV/{id}','QLBaiViet@XoaBV')->name('xoaBV');
Route::post('suaBV/{id}','QLBaiViet@SuaBV')->name('suaBV');

//Quản lý địa điểm khách sạn
Route::get('danhsachKS', 'QLDiaDiemKhachSan@DanhSachKS')->name('danhsachKS');
Route::post('themKS','QLDiaDiemKhachSan@ThemKS')->name('themKS');
Route::post('xoaKS/{id}','QLDiaDiemKhachSan@XoaKS')->name('xoaKS');
Route::post('suaKS/{id}','QLDiaDiemKhachSan@SuaKS')->name('suaKS');
