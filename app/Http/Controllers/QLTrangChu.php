<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\diadiemdulich;
use App\huyenxa;
use DB;
use Session;
class QLTrangChu extends Controller
{
    //
    function TrangChu (){
        $datadl = DB::select('select ST_X(geom), ST_Y(geom),tenlink, img, tendiadiem, gid, diachi, tenrutgon from public.diadiemdulich_khachsan_point;');
        $dataks = DB::select('select ST_X(geom), ST_Y(geom), img, sao, tenkhachsan, gid, diachi from public.khachsan_point;');    
        $datadlnb = DB::select('select * from diadiemdulich_khachsan_point limit 6;');
        $dataksnb = DB::select('select * from khachsan_point order by khachsan_point.gid asc limit 6;');
        return view('pages.trangchu',['datadl'=>$datadl,'dataks'=>$dataks, 'datadlnb'=>$datadlnb,'dataksnb'=>$dataksnb]);
    }
}
