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
        //test
        
        $data = DB::select('select ST_X(geom), ST_Y(geom),* from public.khachsan_point;');
        $datavung= DB::select('select ST_AsGeoJSON(geom),* from public.huyenphuongxa_region;');

        return view('pages.admin.qlkhachsan',['dskhachsan'=>$dskhachsan,'data'=>$data,'datavung'=>$datavung]);
    }

    public function ThemKS(Request $req){
        // $data1 = $req->all();
        // dd($data1);

        $data = DB::table('khachsan_point')->insert(['idvung'=>$req->idvung, 'tenlink'=>$req->tenlink,'giaphong'=>$req->giaphong,'sao'=>$req->sao,'img'=>$req->url1,'tenkhachsan'=>$req->tenkhachsan,'diachi'=>$req->diachi,
        'geom'=>DB::raw("ST_GeomFromText('POINT(".$req->toadox." ".$req->toadoy.")', 4326)")]);
        if ($data) {
		    Session::flash('success', 'Thêm thành công!');
        }else {
            Session::flash('error', 'Thêm thất bại!');
        }
        return redirect('danhsachKS');
    }

    public function SuaKS(Request $req, $id){
        // $data1 = $req->all();
        // dd($data1);
        $data = DB::table('khachsan_point')
              ->where('gid', $id)
              ->update(['tenkhachsan'=>$req->tenkhachsan,
                        'giaphong'=>$req->giaphong,
                        'sao'=>$req->sao,
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

    public function XoaKS($id){
        $data = khachsan::destroy($id);
        if ($data) {
		    Session::flash('success', 'Xóa thành công!');
        }else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect()->back();
    }

    public function ChiTietKhachSan($link){
        $data1=DB::select('select hinhanh.* from public.hinhanh join public.chitietkhachsan 
                        on  chitietkhachsan.id = hinhanh.idchitietkhachsan join khachsan_point 
                        on chitietkhachsan.idkhachsan = khachsan_point.gid 
                        where khachsan_point.tenlink = ?',[$link]);
        
        $data = DB::select('select ST_X(geom), ST_Y(geom), * from public.khachsan_point join chitietkhachsan on  chitietkhachsan.idkhachsan = khachsan_point.gid where khachsan_point.tenlink = ?',[$link]);
        $datadl = DB::select('select ST_X(geom), ST_Y(geom), tenlink, img, tendiadiem, gid, diachi, tenrutgon from public.diadiemdulich_khachsan_point;');
        $dataks = DB::select('select ST_X(geom), ST_Y(geom), tenlink, tenkhachsan, img, sao, gid, diachi from public.khachsan_point;'); 
        
        $datatk = DB::table('khachsan_point')
                ->where('khachsan_point.tenlink','=',$link)
                ->select('*')
                ->orderBy('khachsan_point.gid', 'asc')
                ->first();
          

        $datatimkiem = DB::table('khachsan_point')
                    ->where('khachsan_point.tenlink','!=',$link)
                    ->where('khachsan_point.idvung','=',$datatk->idvung)
                    ->select('*')
                    ->orderBy('khachsan_point.gid', 'asc')
                    ->limit(3)
                    ->get();
        // dd($datatimkiem);
        return view('pages.khachsanx',['datatimkiem'=>$datatimkiem, 'data'=>$data, 'data1'=>$data1, 'datadl'=>$datadl, 'dataks'=>$dataks]);
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

    
    public function DSKhachSan(Request $req){
        if ($req->session()->exists('timkiem') || $req->session()->exists('timkiemnangcao')) {
            $req->session()->forget('timkiem');
            $req->session()->forget('timkiemnangcao');
        }
        $dshuyenxa = DB::table('huyenphuongxa_region')
                    ->select('*')
                    ->orderBy('huyenphuongxa_region.gid', 'asc')
                    ->get();
        $pageSize = 6;
        $data = DB::table('khachsan_point')
                ->select('*')
                ->orderBy('khachsan_point.gid', 'asc')
                ->paginate($pageSize);
        // $data1 = DB::select('select ST_X(geom), ST_Y(geom),* from public.khachsan_point order by public.khachsan_point.gid asc');
        $dataks = DB::select('select ST_X(geom), ST_Y(geom), giaphong, tenlink, tenkhachsan, img, sao, gid, diachi from public.khachsan_point;');     
        $datadl = DB::select('select ST_X(geom), ST_Y(geom), tenlink, img, tendiadiem, gid, diachi, tenrutgon from public.diadiemdulich_khachsan_point;');

        return view('pages.khachsan',['data'=>$data, 'dshuyenxa'=>$dshuyenxa, 'datadl'=>$datadl, 'dataks'=>$dataks, 'pageSize'=>$pageSize]);
    }

    public function TimKiemKhachSan(Request $req){
        if ($req->session()->exists('timkiemnangcao')) {
            $req->session()->forget('timkiemnangcao');
        }
        session()->put('timkiem','timkiem');
        $pageSize = 6;
        $data = DB::table('khachsan_point')
                ->select('*')
                ->orderBy('khachsan_point.gid', 'asc')
                ->paginate($pageSize);
        $dataks = DB::select('select ST_X(geom), ST_Y(geom), giaphong, tenlink, tenkhachsan, img, sao, gid, diachi from public.khachsan_point;');
        $datadl = DB::select('select ST_X(geom), ST_Y(geom), tenlink, img, tendiadiem, gid, diachi, tenrutgon from public.diadiemdulich_khachsan_point;');

        $dshuyenxa = DB::table('huyenphuongxa_region')
                    ->select('*')
                    ->orderBy('huyenphuongxa_region.gid', 'asc')
                    ->get();

        $input = $req->myInput;
        $datatimkiem = khachsan::where('tenkhachsan','LIKE','%'.$input.'%')->paginate($pageSize);
        return view('pages.khachsan',['data'=>$data, 'datadl'=>$datadl, 'dataks'=>$dataks, 'dshuyenxa'=>$dshuyenxa, 'pageSize'=>$pageSize, 'datatimkiem'=>$datatimkiem]);
    }

    public function TimKiemKhachSanNangCao(Request $req){
        if ($req->session()->exists('timkiem')) {
            $req->session()->forget('timkiem');
        }
        $dataks = DB::select('select ST_X(geom), ST_Y(geom), giaphong, tenlink, tenkhachsan, img, sao, gid, diachi from public.khachsan_point;');
        $datadl = DB::select('select ST_X(geom), ST_Y(geom), tenlink, img, tendiadiem, gid, diachi, tenrutgon from public.diadiemdulich_khachsan_point;');

        $pageSize = 6;
        $data = DB::table('khachsan_point')
                ->select('*')
                ->orderBy('khachsan_point.gid', 'asc')
                ->paginate($pageSize);
        $dataks = DB::select('select ST_X(geom), ST_Y(geom), giaphong, tenlink, tenkhachsan, img, sao, gid, diachi from public.khachsan_point;');
        $dshuyenxa = DB::table('huyenphuongxa_region')
                    ->select('*')
                    ->orderBy('huyenphuongxa_region.gid', 'asc')
                    ->get();
        $datatimkiemnangcao = $req->all();
        if( $datatimkiemnangcao == null)
            return redirect()->back();
        session()->put('timkiemnangcao','timkiemnangcao');
        // $mucgia = $req->mucgia;
        $xephang = $req->xephang;
        $khuvuc = $req->khuvuc;
        $datakhuvuc = huyenxa::find($khuvuc);

        if($xephang != null && $khuvuc != null)
        {
            $datanangcao = DB::table('khachsan_point')
                    ->join('huyenphuongxa_region', 'khachsan_point.idvung', '=', 'huyenphuongxa_region.gid')
                    ->where('khachsan_point.sao',$xephang)
                    ->where('huyenphuongxa_region.gid',$khuvuc)
                    ->select('*')
                    ->orderBy('khachsan_point.gid', 'asc')
                    ->paginate($pageSize);
            return view('pages.khachsan',['datadl'=>$datadl, 'dataks'=>$dataks, 'data'=>$data, 'xephang'=>$xephang, 'datakhuvuc'=>$datakhuvuc, 'datanangcao'=>$datanangcao, 'dataks'=>$dataks, 'dshuyenxa'=>$dshuyenxa, 'pageSize'=>$pageSize]);

        }
        elseif($khuvuc != null){
            $datanangcao = DB::table('khachsan_point')
                    ->join('huyenphuongxa_region', 'khachsan_point.idvung', '=', 'huyenphuongxa_region.gid')
                    ->where('huyenphuongxa_region.gid',$khuvuc)
                    ->select('*')
                    ->orderBy('khachsan_point.gid', 'asc')
                    ->paginate($pageSize);
            return view('pages.khachsan',['datadl'=>$datadl, 'dataks'=>$dataks,'data'=>$data, 'xephang'=>$xephang, 'datakhuvuc'=>$datakhuvuc, 'datanangcao'=>$datanangcao, 'dataks'=>$dataks, 'dshuyenxa'=>$dshuyenxa, 'pageSize'=>$pageSize]);

        }
        else{
            $datanangcao = DB::table('khachsan_point')
                    ->join('huyenphuongxa_region', 'khachsan_point.idvung', '=', 'huyenphuongxa_region.gid')
                    ->where('khachsan_point.sao',$xephang)
                    ->select('*')
                    ->orderBy('khachsan_point.gid', 'asc')
                    ->paginate($pageSize);
            return view('pages.khachsan',['datadl'=>$datadl, 'dataks'=>$dataks,'data'=>$data, 'xephang'=>$xephang, 'datakhuvuc'=>$datakhuvuc, 'datanangcao'=>$datanangcao, 'dataks'=>$dataks, 'dshuyenxa'=>$dshuyenxa, 'pageSize'=>$pageSize]);

        }
    }
}
