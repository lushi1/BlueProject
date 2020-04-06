<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\baiviet;
use DB;
use Session;
use Hash;
class QLBaiViet extends Controller
{
    //
    public function DanhSachBV(){

        $dsbaiviet = baiviet::all();
       
        return view('pages.admin.qlbaiviet',['dsbaiviet'=>$dsbaiviet]);
    }

    public function ThemBV(Request $req){

        $baiviet = new baiviet();
        $baiviet->tieude=$req->tieude;
        $baiviet->noidung=$req->noidung;
        $baiviet->chubaiviet= Session::get('id');
        $baiviet->ngaytao= Carbon\Carbon::now();
        $baiviet->save();
        return view('pages.admin.qlbaiviet',['dsbaiviet'=>$dsbaiviet]);
    }
}
