<?php

namespace App\Http\Controllers;

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
}
