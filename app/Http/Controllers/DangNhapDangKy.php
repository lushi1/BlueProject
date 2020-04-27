<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\taikhoan;
use DB;
use Session;
use Hash;
class DangNhapDangKy extends Controller
{

    public function TrangDangNhap()
    {
        if(session()->has('tenkh'))
            return redirect('trang-chu');
        else if (session()->has('tenadmin'))
            return redirect('danhsachTK'); 
        else
            return view('pages.dangnhap');
    }
 
    public function DangNhap(Request $req){
        $tentaikhoan = $req->email;
        $matkhau = $req->matkhau;
        $dn=taikhoan::where('tentaikhoan',$tentaikhoan)->get();
        if($dn!=null)
        {
            foreach($dn as $lg)
            {              
                if(Hash::check($matkhau, $lg->matkhau))
                // if($lg->matkhau == $matkhau)
                {
                    if($lg->loaitaikhoan==1)
                    {
                        session()->put('tenkh',$lg->tentaikhoan);
                        session()->put('id',$lg->id);                     
                        return redirect('trang-chu');
                    }
                    else if($lg->loaitaikhoan==0)
                    {
                        session()->put('tenadmin',$lg->tentaikhoan);
                        session()->put('id',$lg->id);
                        return redirect('danhsachTK');
                    }
                }
            }
            Session::flash('error', 'Mật khẩu không chính xác!');
            return redirect('trangdangnhap');
        }
        Session::flash('error', 'Tên tài khoản không tồn tại!');
        return redirect('trangdangnhap');
    }

    // public function TrangDangKy()
    // {
    //     if(session()->has('tenadmin') || session()->has('tenadmin'))
    //         return redirect('trang-chu');
    //     else
    //         return view('pages.dangnhap');
    // }

    // public function DangKy(Request $req){
    //     $dstk = DB::table('taikhoan')->value('tentaikhoan');
    //     Session::flash('email', 'Tên tài khoản đã tồn tại!');
    //     foreach($dstk as $tk){
    //         if($tk == $req->tentaikhoan)
    //             return redirect('trangdangky');
    //     }
    //     return redirect('trangdangnhap');
    // }

    public function Thoat(){
        Session::flush();
        return redirect('trangdangnhap');
    }
}
