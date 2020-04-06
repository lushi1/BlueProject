<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\baiviet;
use DB;
use Session;
use Hash;
class QLBaiViet extends Controller
{
    //
    public function DanhSachBV(){

        $dsbaiviet = baiviet::all();
       
        return view('pages.admin.qlbaiviet',['dsbaiviet'=>$dsbaiviet]);
    }

    public function ThemBV(Request $req){

        $baiviet = new baiviet();
        $baiviet->tieude=$req->tieude;
        $baiviet->noidung=$req->noidung;
        $baiviet->chubaiviet= Session::get('id');
        $baiviet->ngaytao= Carbon::now();
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
}
