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
                if(Hash::check($matkhau, $lg->matkhau))
                // if($lg->matkhau == $matkhau)
                {
                    if($lg->loaitaikhoan==1)
                    {
                        session()->put('tenkh',$lg->tentaikhoan);
                        session()->put('id',$lg->id);                     
                        return redirect('trangchu');
                    }
                    else if($lg->loaitaikhoan==0)
                    {
                        session()->put('tenadmin',$lg->tentaikhoan);
                        session()->put('id',$lg->id);
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
