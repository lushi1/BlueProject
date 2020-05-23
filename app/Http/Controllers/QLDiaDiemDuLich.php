<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\diadiemdulich;
use App\huyenxa;
use DB;
use Session;
class QLDiaDiemDuLich extends Controller
{
    //
    public function DanhSachDL(){

        $data = DB::select('select ST_X(geom), ST_Y(geom),img,tenlink,tendiadiem,gid,diachi from public.diadiemdulich_khachsan_point;');    
        return view('pages.admin.qldiadiemdulich',['data'=>$data]);
    }

    public function ThemDL(Request $req){
        $data = DB::table('diadiemdulich_khachsan_point')->insert(['img'=>$req->url1,'tendiadiem'=>$req->tendiadiem,'diachi'=> $req->diachi,
        'geom'=>DB::raw("ST_GeomFromText('POINT(".$req->toadox." ".$req->toadoy.")', 4326)")]);
        
        return redirect('danhsachDL');
    }

    public function SuaDL(Request $req, $id){
        $data = DB::table('diadiemdulich_khachsan_point')
              ->where('gid', $id)
              ->update(['tendiadiem'=>$req->tendiadiem,
                        'img'=>$req->img,
                        'geom'=>DB::raw("ST_GeomFromText('POINT(".$req->toadox." ".$req->toadoy.")', 4326)"),
                        'diachi'=>$req->diachi]);      
        
        return redirect()->back();
    }

    public function XoaDL($id){
        $data = diadiemdulich::destroy($id);
        if ($data) {
		    Session::flash('success', 'Xóa tài khoản thành công!');
        }else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect()->back();
    }
    
}
