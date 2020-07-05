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
Route::get('danh-gia/{url}', 'QLBaiViet@ChiTietBV')->name('{url}');

//Quản lý địa điểm khách sạn
Route::get('danhsachKS', 'QLDiaDiemKhachSan@DanhSachKS')->name('danhsachKS');
Route::post('themKS','QLDiaDiemKhachSan@ThemKS')->name('themKS');
Route::post('xoaKS/{id}','QLDiaDiemKhachSan@XoaKS')->name('xoaKS');
Route::post('suaKS/{id}','QLDiaDiemKhachSan@SuaKS')->name('suaKS');

//Trang chi tiết khách sạn
Route::get('/khach-san-son-thuy-2','QLDiaDiemKhachSan@ChiTietKhachSan')->name('khach-san-son-thuy-2');

//Quản lý địa điểm du lịch
Route::get('danhsachDL', 'QLDiaDiemDuLich@DanhSachDL')->name('danhsachDL');
Route::post('themDL','QLDiaDiemDuLich@ThemDL')->name('themDL');
Route::post('xoaDL/{id}','QLDiaDiemDuLich@XoaDL')->name('xoaDL');
Route::post('suaDL/{id}','QLDiaDiemDuLich@SuaDL')->name('suaDL');

//Quản lý thống kê
Route::get('thong-ke/diem-du-lich', 'QLThongKe@ThongKeDiemDuLich')->name('diem-du-lich');
Route::get('thong-ke/khach-san', 'QLThongKe@ThongKeKhachSan')->name('khach-san');

//Thoát
Route::get('thoat', 'DangNhapDangKy@Thoat')->name('thoat');

