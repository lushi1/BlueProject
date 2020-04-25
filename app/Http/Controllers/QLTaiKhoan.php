<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\taikhoan;
use App\loaitaikhoan;
use DB;
use Session;
use Hash;
class QLTaiKhoan extends Controller
{
    public function DanhSachTK(){
        $dstaikhoan = taikhoan::all();
        $dsloaitk = loaitaikhoan::all();       
        return view('pages.admin.qltaikhoan',['dstaikhoan'=>$dstaikhoan, 'dsloaitk'=>$dsloaitk]);
    }

    public function ThemTK(Request $req){
        // Session::flash('errortk', 'Thêm thất bại! Tên tài khoản đã tồn tại!');
        $dstk = taikhoan::all();
        // foreach($dstk as $tk){
        //     if($tk->tentaikhoan == $req->tentaikhoan)
        //     {
        //         return redirect('danhsachTK');
        //     }
        // }
        $matkhau = $req->matkhau;
        $xacnhanmatkhau = $req->xacnhanmatkhau;
        if($matkhau == $xacnhanmatkhau)
        {
            $matkhaumoi = Hash::make($matkhau);
            $taikhoan = new taikhoan();
            $taikhoan->tentaikhoan = $req->tentaikhoan;
            $taikhoan->matkhau = $matkhaumoi;
            $taikhoan->loaitaikhoan = $req->loaitaikhoan;
            $taikhoan->save();
            return redirect()->back();
        }
        else
        {
            Session::flash('error', 'Thêm thất bại! Mật khẩu xác nhận không trùng khớp!');
            return redirect('danhsachTK');
        }
    }

    public function XoaTK($id){
        $xoataikhoan = taikhoan::destroy($id);
        if ($xoataikhoan) {
		    Session::flash('success', 'Xóa tài khoản thành công!');
        }else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect()->back();
    }

    
}
