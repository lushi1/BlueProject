<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\diadiemdulich;
use App\khachsan;
use App\huyenxa;
use DB;
use Session;
class QLThongKe extends Controller
{
    public function ThongKeKhachSan(){
        $pageSize = 6;
        $dskhachsan = khachsan::all();
        $dshuyenxa = DB::table('huyenphuongxa_region')->paginate($pageSize);
        return view('pages.admin.qlthongkekhachsan',['dskhachsan'=>$dskhachsan,'dshuyenxa'=>$dshuyenxa, 'pageSize'=>$pageSize]);

    }

    public function ThongKeDiemDuLich(){
        $pageSize = 6;
        $dsdiemdulich = diadiemdulich::all();
        $dshuyenxa = DB::table('huyenphuongxa_region')->paginate($pageSize);
        return view('pages.admin.qlthongkediemdulich',['dsdiemdulich'=>$dsdiemdulich,'dshuyenxa'=>$dshuyenxa, 'pageSize'=>$pageSize]);
    }

    public function ThongKe(Request $req){
        if ($req->session()->exists('check')) {
            $req->session()->forget('check');
        }
        if ($req->session()->exists('check1')) {
            $req->session()->forget('check1');
        }
        if ($req->session()->exists('check2')) {
            $req->session()->forget('check2');
        }
        return view('pages.admin.qlthongke');
    }

    public function ThongKeChiTiet(Request $req){
        session()->put('check','check');
        if($req->loaithongke == 0 && $req->loaiyeucau == 0)
        {
            session()->put('check1','check1');
            $ds = DB::select('select huyenxa.ten, count(khachsan.gid)
            from huyenphuongxa_region huyenxa join khachsan_point khachsan
            on huyenxa.gid = khachsan.idvung
            group by huyenxa.ten');
            return view('pages.admin.qlthongke',['ds'=>$ds]);
        }
        elseif($req->loaithongke == 1 && $req->loaiyeucau == 0){
            if ($req->session()->exists('check1')) {
                $req->session()->forget('check1');
            }
            session()->put('check2','check2');
            $ds = DB::select('select huyenxa.ten, count(diemdulich.gid)
            from huyenphuongxa_region huyenxa join diadiemdulich_khachsan_point diemdulich
            on huyenxa.gid = diemdulich.idvung
            group by huyenxa.ten');
            return view('pages.admin.qlthongke',['ds'=>$ds]);
        }
        else{
            
            return view('pages.admin.qlthongke');
        }      
    }

    // public function ajaxRequest(Request $request)
    // {
    //     $input = $request->all();
    //     $check = 1;
    //     return response()->json(['success'=>'Got Simple Ajax Request.','test'=>$input, 'check'=>$check]);
    // }
}
