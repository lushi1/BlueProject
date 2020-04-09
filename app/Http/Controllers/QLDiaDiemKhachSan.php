<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\khachsan;
use App\huyenxa;
use DB;
class QLDiaDiemKhachSan extends Controller
{
    //
    public function DanhSachKS(){
        $dskhachsan = khachsan::all();
        $data = DB::select('select ST_X(geom), ST_Y(geom),tenkhachsan from public.khachsan_point;');    
        return view('pages.admin.qlkhachsan',['dskhachsan'=>$dskhachsan,'data'=>$data]);
    }

}
