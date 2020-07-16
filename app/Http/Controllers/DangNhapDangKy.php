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
                else{
                    Session::flash('error', 'Mật khẩu không chính xác!');
                    return redirect('trang-dang-nhap');
                }
            }
        }
        Session::flash('error', 'Tên tài khoản không tồn tại!');
        return redirect('trang-dang-nhap');
    }

    public function TrangDangKy()
    {
        if(session()->has('tenadmin') || session()->has('tenadmin'))
            return redirect('trang-chu');
        else
            return view('pages.dangky');
    }

    public function DangKy(Request $req){
        $dstk = taikhoan::all();
        foreach($dstk as $tk){
            if($tk->tentaikhoan == $req->tentaikhoan || $tk->email == $req->email)
            {
                if($tk->tentaikhoan == $req->tentaikhoan)
                    Session::flash('tentaikhoan', 'Tên tài khoản đã tồn tại!');
                if($tk->email == $req->email)
                    Session::flash('email', 'Tên email đã tồn tại!');
                return redirect('dang-ky');
            }
        }
        $taikhoan = new taikhoan();
        $taikhoan->tentaikhoan = $req->tentaikhoan;
        $taikhoan->email = $req->email;
        $taikhoan->hoten = $req->hoten;
        $taikhoan->loaitaikhoan = 1;
        $taikhoan->matkhau = $req->pass;
        $taikhoan->save();
        return redirect('trang-dang-nhap');
    }

    public function Thoat(){
        Session::flush();
        return redirect('trang-dang-nhap');
    }
}
