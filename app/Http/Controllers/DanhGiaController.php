<?php

namespace App\Http\Controllers;

use App\Models\Mau01A;
use App\Models\PhieuDanhGia;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DanhGiaController extends Controller
{
    public function mau01A()
    {
        $mau_danh_gia = Mau01A::all();
        $thoi_diem_danh_gia = Carbon::now()->subMonth();
        $user = User::where('so_hieu_cong_chuc', Auth::user()->so_hieu_cong_chuc)
            ->leftjoin('chuc_vu', 'chuc_vu.ma_chuc_vu', 'users.ma_chuc_vu')
            ->leftjoin('don_vi', 'don_vi.ma_don_vi', 'users.ma_don_vi')
            ->select('users.*', 'chuc_vu.ten_chuc_vu', 'don_vi.ten_don_vi')
            ->first();

        return view(
            'danhgia.mau01A',
            [
                'mau_danh_gia' => $mau_danh_gia,
                'thoi_diem_danh_gia' => $thoi_diem_danh_gia,
                'user' => $user
            ]
        );
    }


    public function ketquatudanhgia(Request $request)
    {
        $tc_110 = $request->tc_111 + $request->tc_112 + $request->tc_113 + $request->tc_114;
        $tc_130 = $request->tc_131 + $request->tc_132 + $request->tc_133 + $request->tc_134;
        $tc_150 = $request->tc_151 + $request->tc_152 + $request->tc_153 + $request->tc_154;
        $tc_170 = $request->tc_171 + $request->tc_172 + $request->tc_173;
        $tc_100 = $tc_110 + $tc_130 + $tc_150 + $tc_170;
        $tc_210 = $request->tc_211 + $request->tc_212 + $request->tc_213 + $request->tc_214 + $request->tc_215 + $request->tc_216 + $request->tc_217 + $request->tc_218 + $request->tc_219 + $request->tc_220;
        $tc_230 =  $request->tc_230;
        $tc_200 = $tc_210 + $tc_230;
        $tc_300 = $tc_100 + $tc_200;
        $tc_400 = $request->diem_cong;
        $tc_500 = $request->diem_tru;        
        $tong_diem_tu_cham = $tc_300 + $tc_400 - $tc_500;
        $phieu_danh_gia = new PhieuDanhGia();
        $phieu_danh_gia->ma_phieu_danh_gia = $request->nam_danh_gia . $request->thang_danh_gia . Auth::user()->so_hieu_cong_chuc;
        $phieu_danh_gia->thoi_diem_danh_gia = $request->nam_danh_gia . $request->thang_danh_gia;
        $phieu_danh_gia->so_hieu_cong_chuc = Auth::user()->so_hieu_cong_chuc;
        $phieu_danh_gia->ma_chuc_vu = Auth::user()->ma_chuc_vu;
        $phieu_danh_gia->ma_phong = Auth::user()->ma_phong;
        $phieu_danh_gia->ma_don_vi = Auth::user()->ma_don_vi;
        $phieu_danh_gia->tong_diem_tu_cham = $tong_diem_tu_cham;
        $phieu_danh_gia->ma_trang_thai = 11;
        $phieu_danh_gia->save();
    }
}
