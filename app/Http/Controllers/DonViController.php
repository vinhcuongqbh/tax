<?php

namespace App\Http\Controllers;

use App\Models\DonVi;
use Illuminate\Http\Request;

class DonViController extends Controller
{
    public function index()
    {
        //Hiển thị danh sách Đơn vị đang sử dụng
        $don_vi = DonVi::leftjoin('don_vi as dv2', 'dv2.ma_don_vi', 'don_vi.ma_don_vi_cap_tren')
            ->select('don_vi.id','don_vi.ma_don_vi','don_vi.ten_don_vi', 'dv2.ten_don_vi as ten_don_vi_cap_tren', 'don_vi.id_trang_thai')
            ->get();

        return view('donvi.index', ['don_vi' => $don_vi]);
    }

    //Khóa Đơn vị
    public function destroy($id)
    {
        $don_vi = DonVi::where('ma_don_vi', $id)->first();
        $don_vi->id_trang_thai = 0;
        $don_vi->save();

        return back()->with('message', 'Đã khóa Đơn vị');
    }


    //Khóa Đơn vị
    public function restore($id)
    {
        $don_vi = DonVi::where('ma_don_vi', $id)->first();
        $don_vi->id_trang_thai = 1;
        $don_vi->save();

        return back()->with('message', 'Đã mở Đơn vị');
    }
}
