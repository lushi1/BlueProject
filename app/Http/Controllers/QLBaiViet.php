<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\baiviet;
use App\diadiemdulich;
use DB;
use Session;
use Hash;
class QLBaiViet extends Controller
{
    //
    public function DanhSachBV(){
        $dsbaiviet = DB::table('baiviet')
        ->join('taikhoan', 'baiviet.chubaiviet', '=', 'taikhoan.id')
        ->select('baiviet.*', 'taikhoan.tentaikhoan')
        ->get();
        // $dsbaiviet = baiviet::all();
        $dsdulich = DB::table('diadiemdulich_khachsan_point')->orderBy('gid', 'asc')->get();
        return view('pages.admin.qlbaiviet',['dsbaiviet'=>$dsbaiviet,'dsdulich'=>$dsdulich]);
    }

    public function ThemBV(Request $req){

        $baiviet = new baiviet();
        $baiviet->tieude=$req->tieude;
        $baiviet->noidung=$req->noidung;
        $baiviet->chubaiviet= Session::get('id');
        $baiviet->ngaytao= Carbon::now();
        $baiviet->view = 0;
        $baiviet->dulich_id = $req->dulich_id;
        $baiviet->save();
        return redirect('danhsachBV');
    }


    public function XoaBV($id){
        $xoabaiviet = baiviet::destroy($id);
        if ($xoabaiviet) {
		    Session::flash('success', 'Xóa tài khoản thành công!');
        }else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect()->back();
    } 
    
    public function SuaBV($id,Request $req){
        $baiviet = baiviet::find($id);
        $sua = "sua".$baiviet->id;
        $noidung = $sua.$sua;
        $baiviet->tieude=$req->tieude;
        $baiviet->noidung= $req->$noidung;
        $baiviet->save();
        if ($baiviet) {
		    Session::flash('success', 'Sửa thành công!');
        }else {
            Session::flash('error', 'Sửa thất bại!');
        }
        return redirect()->back();
    }
    
    public function DanhSachRV(){
        $ds = DB::table('baiviet')
        ->join('taikhoan', 'baiviet.chubaiviet', '=', 'taikhoan.id')
        ->where('tag','=','tonghopreview')
        ->first();

        $data = DB::table('baiviet')
        ->where('tag','=','tonghopreview')
        ->first();

        $baivietx = baiviet::find($data->id);
        $baivietx->view = $baivietx->view + 1;
        $baivietx->save();

        $dsdiadiemdl = DB::table('diadiemdulich_khachsan_point')->orderBy('gid', 'asc')->get();
        return view('pages.tonghopreview',['dsdiadiemdl'=>$dsdiadiemdl,'ds'=>$ds]);
    }

    public function ChiTietBV($url){

        $data = DB::table('baiviet')   
        ->join('diadiemdulich_khachsan_point', 'baiviet.dulich_id', '=', 'diadiemdulich_khachsan_point.gid')
        ->join('taikhoan', 'baiviet.chubaiviet', '=', 'taikhoan.id')        
        ->where('diadiemdulich_khachsan_point.tenlink','=',$url)
        ->select('baiviet.*','taikhoan.tentaikhoan','diadiemdulich_khachsan_point.*')
        ->first();

        $baiviet = baiviet::find($data->id);
        $baiviet->view = $baiviet->view + 1;
        $baiviet->save();

        $datatuongtu1 = DB::table('baiviet')
        ->join('diadiemdulich_khachsan_point', 'baiviet.dulich_id', '=', 'diadiemdulich_khachsan_point.gid')    
        ->where('baiviet.id','!=',$data->id)
        ->select('*')
        ->orderByDesc('baiviet.id')
        ->limit(3)
        ->get();

        $datatuongtu2 = DB::table('baiviet')
        ->join('diadiemdulich_khachsan_point', 'baiviet.dulich_id', '=', 'diadiemdulich_khachsan_point.gid')           
        ->where('baiviet.id','!=',$data->id)
        ->whereNull('tag')
        ->select('*')
        ->orderBy('baiviet.id','asc')
        ->limit(3)
        ->get();
        // dd($datatuongtu2);
        $dt = DB::select('select ST_X(geom), ST_Y(geom),tenlink, img, tendiadiem, gid, diachi, tenrutgon from public.diadiemdulich_khachsan_point where tenlink = ?',[$url]);        
        $datadl = DB::select('select ST_X(geom), ST_Y(geom), tenlink, img, tendiadiem, gid, diachi, tenrutgon from public.diadiemdulich_khachsan_point;');
        $dataks = DB::select('select ST_X(geom), ST_Y(geom), tenlink, tenkhachsan, img, sao, gid, diachi from public.khachsan_point;');    
        return view('pages.chitietbaiviet',['datatuongtu1'=>$datatuongtu1, 'datatuongtu2'=>$datatuongtu2, 'data'=>$data,'url'=>$url,'datadl'=>$datadl,'dataks'=>$dataks,'dt'=>$dt]);
    }
}
