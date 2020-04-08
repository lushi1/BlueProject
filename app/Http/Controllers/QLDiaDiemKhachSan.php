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
        $dshuyenxa = huyenxa::all();
        $data = DB::select('select st_asgeojson(st_transform(geom,4326)) from public.huyenphuongxa_region;');
           
        return view('pages.admin.qlkhachsan',['dskhachsan'=>$dskhachsan, 'dshuyenxa'=>$dshuyenxa]);
    }

}
