<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\khachsan;
use App\chitietkhachsan;
use App\huyenxa;
use DB;
use Session;
class QLDiaDiemKhachSan extends Controller
{
    //
    public function DanhSachKS(){
        $dskhachsan = khachsan::all();
        
        $data = DB::select('select ST_X(geom), ST_Y(geom),img,tenkhachsan,gid, diachi from public.khachsan_point;');    
        return view('pages.admin.qlkhachsan',['dskhachsan'=>$dskhachsan,'data'=>$data,]);
    }

    public function ThemKS(Request $req){
        $data = DB::table('khachsan_point')->insert(['img'=>$req->url1,'tenkhachsan'=>$req->tenkhachsan,'diachi'=>$req->diachi,
        'geom'=>DB::raw("ST_GeomFromText('POINT(".$req->toadox." ".$req->toadoy.")', 4326)")]);
        
        return redirect('danhsachKS');
    }

    public function SuaKS(Request $req, $id){
        $data = DB::table('khachsan_point')
              ->where('gid', $id)
              ->update(['tenkhachsan'=>$req->tenkhachsan,
                        'img'=>$req->img,
                        'geom'=>DB::raw("ST_GeomFromText('POINT(".$req->toadox." ".$req->toadoy.")', 4326)"),
                        'diachi'=>$req->diachi]);      
        
        return redirect()->back();
    }

    public function XoaKS($id){
        $data = khachsan::destroy($id);
        if ($data) {
		    Session::flash('success', 'Xóa tài khoản thành công!');
        }else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect()->back();
    }

    public function ChiTietKhachSan($link){
        // $data = DB::table('khachsan_point')
        // ->where('khachsan_point.tenlink','=',$link)
        // ->join('chitietkhachsan', 'khachsan_point.idctks', '=', 'chitietkhachsan.id')
        // ->select('chitietkhachsan.noidung, khachsan_point.*')
        // ->first();
        $data1=DB::select('select hinhanh.* from public.hinhanh join public.chitietkhachsan 
                        on  chitietkhachsan.id = hinhanh.idchitietkhachsan join khachsan_point 
                        on chitietkhachsan.idkhachsan = khachsan_point.gid 
                        where khachsan_point.tenlink = ?',[$link]);
        $data = DB::select('select ST_X(geom), ST_Y(geom), * from public.khachsan_point join chitietkhachsan on  chitietkhachsan.idkhachsan = khachsan_point.gid where khachsan_point.tenlink = ?',[$link]);
        $datadl = DB::select('select ST_X(geom), ST_Y(geom), tenlink, img, tendiadiem, gid, diachi, tenrutgon from public.diadiemdulich_khachsan_point;');
        $dataks = DB::select('select ST_X(geom), ST_Y(geom), tenlink, tenkhachsan, img, sao, gid, diachi from public.khachsan_point;'); 
        return view('pages.khachsanx',['data'=>$data, 'data1'=>$data1, 'datadl'=>$datadl, 'dataks'=>$dataks]);
    }

    //Chi tiết khách sạn
    public function DanhSachCTKS(){
        $pageSize = 10;
        $dsctkhachsan = DB::table('chitietkhachsan')
        ->join('khachsan_point', 'chitietkhachsan.idkhachsan', '=', 'khachsan_point.gid')
        ->select('chitietkhachsan.*', 'khachsan_point.tenkhachsan')
        ->orderBy('chitietkhachsan.id', 'asc')
        ->paginate($pageSize);
        
        $dskhachsan = DB::table('khachsan_point')
        ->orderBy('gid', 'asc')
        ->get();
        $data = DB::table('khachsan_point')->orderBy('gid', 'asc')->first();
        return view('pages.admin.qlchitietkhachsan',['dsctkhachsan'=>$dsctkhachsan, 'dskhachsan'=>$dskhachsan, 'data'=>$data, 'pageSize'=>$pageSize]);
    }

    public function ThemCTKS(Request $req){
        $data = DB::table('chitietkhachsan')->insert(['noidung'=>$req->noidung, 'idkhachsan'=>$req->khachsan_id]);
        return redirect('danhsachCTKS');
    }

    public function SuaCTKS(Request $req, $id){
        $sua = "sua".$id;
        $noidung = $sua.$sua;
        $data = DB::table('chitietkhachsan')
              ->where('id', $id)
              ->update(['noidung'=>$req->$noidung]);      
        return redirect()->back();
    }

    public function XoaCTKS($id){
        $data = chitietkhachsan::destroy($id);
        if ($data) {
		    Session::flash('success', 'Xóa tài khoản thành công!');
        }else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect()->back();
    }
}
