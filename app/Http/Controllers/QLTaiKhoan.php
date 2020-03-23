<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\taikhoan;
use DB;
use Session;
class QLTaiKhoan extends Controller
{
    public function DanhsachTK(){
        $dstaikhoan = taikhoan::all();
        $dstaikhoan1 = DB::table('taikhoan')->get();       
        return view('pages.admin.qltaikhoan',['dstaikhoan'=>$dstaikhoan, 'dstaikhoan1'=>$dstaikhoan1]);
    }
}
