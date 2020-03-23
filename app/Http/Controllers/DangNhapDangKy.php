<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\taikhoan;
use DB;
use Session;
use Hash;
class DangNhapDangKy extends Controller
{
    public function DangNhap(Request $req){
        $tentaikhoan = $req->email;
        $matkhau = $req->matkhau;
        $dn=taikhoan::where('tentaikhoan',$tentaikhoan)->get();
        if($dn!=null)
        {
            foreach($dn as $lg)
            {              
                // if(Hash::check($matkhaumoi, $lg->matkhau))
                if($lg->matkhau == $matkhau)
                {
                    if($lg->loaitaikhoan==0)
                    {
                        session()->put('tendn',$lg->tentaikhoan);                     
                        return redirect('trangquantri');
                    }
                    else if($lg->loaitaikhoan==1)
                    {
                        session()->put('tenadmin',$lg->tentaikhoan);
                        return redirect('/');
                    }
                }
            }
            Session::flash('error', 'Đăng nhập thất bại!');
            return redirect('trangdangnhap');
        }
        Session::flash('error', 'Đăng nhập thất bại!');
        return redirect('trangdangnhap');
    }
}
