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

        $data = DB::select('select ST_X(geom), ST_Y(geom),* from public.diadiemdulich_khachsan_point;');    
        return view('pages.admin.qldiadiemdulich',['data'=>$data]);
    }

    public function ThemDL(Request $req){
        
        $checkvung = DB::table('huyenphuongxa_region')
        ->select('*')
        ->where('huyenphuongxa_region.ten',$req->idvung)->first();
        $data = DB::table('diadiemdulich_khachsan_point')->insert(['tenrutgon'=>$req->tenrutgon,'tenlink'=>$req->tenlink,
        'idvung'=>$checkvung->gid,'img'=>$req->url1,'tendiadiem'=>$req->tendiadiem,'diachi'=> $req->diachi,
        'geom'=>DB::raw("ST_GeomFromText('POINT(".$req->toadox." ".$req->toadoy.")', 4326)")]);
        if ($data) {
		    Session::flash('success', 'Thêm thành công!');
        }else {
            Session::flash('error', 'Thêm thất bại!');
        }
        return redirect('danhsachDL');
    }

    public function SuaDL(Request $req, $id){
        $data = DB::table('diadiemdulich_khachsan_point')
              ->where('gid', $id)
              ->update(['tendiadiem'=>$req->tendiadiem,
                        'tenrutgon'=>$req->tenrutgon,
                        'tenlink'=>$req->tenlink,
                        'img'=>$req->img,
                        'geom'=>DB::raw("ST_GeomFromText('POINT(".$req->toadox." ".$req->toadoy.")', 4326)"),
                        'diachi'=>$req->diachi]);      
        if ($data) {
            Session::flash('success', 'Sửa thành công!');
        }else {
            Session::flash('error', 'Sửa thất bại!');
        }
        return redirect()->back();
    }

    public function XoaDL($id){
        $data = diadiemdulich::destroy($id);
        if ($data) {
		    Session::flash('success', 'Xóa thành công!');
        }else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect()->back();
    }
    
}
