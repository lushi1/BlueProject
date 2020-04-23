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
        $datadl = DB::select('select ST_X(geom), ST_Y(geom),tendiadiem,gid,diachi from public.diadiemdulich_khachsan_point;');
        $dataks = DB::select('select ST_X(geom), ST_Y(geom),tenkhachsan,gid, diachi from public.khachsan_point;');    
        return view('pages.trangchu',['datadl'=>$datadl,'dataks'=>$dataks]);
    }
}
