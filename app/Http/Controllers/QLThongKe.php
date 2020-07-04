<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\diadiemdulich;
use App\khachsan;
use App\huyenxa;
use DB;
class QLThongKe extends Controller
{
    public function ThongKeKhachSan(){
        $pageSize = 6;
        // $ds = DB::select('select phuong.gid, phuong.tenphuong, sum((case ST_Contains(phuong.geom, tro.geom)
		// 								when True then 1
		// 								else 0 end)) as sl
        // from vungranhgioiphuongtxtdm_region phuong left join khunhatro_tdm_point tro
        // on ST_Contains(phuong.geom, tro.geom)=True
        // group by phuong.gid, phuong.tenphuong');
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
}
