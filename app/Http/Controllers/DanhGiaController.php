<?php

namespace App\Http\Controllers;

use App\Models\Mau01A;
use App\Models\Mau01B;
use App\Models\PhieuDanhGia;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DanhGiaController extends Controller
{
    public function taophieudanhgia()
    {
        $thoi_diem_danh_gia = Carbon::now()->subMonth();
        $user = User::where('so_hieu_cong_chuc', Auth::user()->so_hieu_cong_chuc)
            ->leftjoin('chuc_vu', 'chuc_vu.ma_chuc_vu', 'users.ma_chuc_vu')
            ->leftjoin('don_vi', 'don_vi.ma_don_vi', 'users.ma_don_vi')
            ->select('users.*', 'chuc_vu.ten_chuc_vu', 'don_vi.ten_don_vi')
            ->first();

        if (Auth::user()->ma_chuc_vu != NULL) {
            $mau_danh_gia = Mau01A::all();
            return view(
                'danhgia.mau01A',
                [
                    'mau_danh_gia' => $mau_danh_gia,
                    'thoi_diem_danh_gia' => $thoi_diem_danh_gia,
                    'user' => $user
                ]
            );
        } else {
            $mau_danh_gia = Mau01B::all();
            return view(
                'danhgia.mau01B',
                [
                    'mau_danh_gia' => $mau_danh_gia,
                    'thoi_diem_danh_gia' => $thoi_diem_danh_gia,
                    'user' => $user
                ]
            );
        }
    }


    public function danhsachtucham()
    {
        $danh_sach_tu_cham = PhieuDanhGia::where('phieu_danh_gia.so_hieu_cong_chuc', Auth::user()->so_hieu_cong_chuc)
            ->leftjoin('users', 'users.so_hieu_cong_chuc', 'phieu_danh_gia.so_hieu_cong_chuc')
            ->leftjoin('chuc_vu', 'chuc_vu.ma_chuc_vu', 'phieu_danh_gia.ma_chuc_vu')
            ->leftjoin('phong', 'phong.ma_phong', 'phieu_danh_gia.ma_phong')
            ->leftjoin('don_vi', 'don_vi.ma_don_vi', 'phieu_danh_gia.ma_don_vi')
            ->select('phieu_danh_gia.*', 'users.name', 'chuc_vu.ten_chuc_vu', 'phong.ten_phong', 'don_vi.ten_don_vi')
            ->orderBy('phieu_danh_gia.ma_phieu_danh_gia', 'DESC')
            ->get();

        return view('danhgia.danhsachtucham', ['danh_sach_tu_cham' => $danh_sach_tu_cham]);
    }



    public function luuphieudanhgia(Request $request)
    {
        //Tạo Mã phiếu đánh giá
        if (($request->thang_danh_gia == '11') || ($request->thang_danh_gia == '12')) $request->thang_danh_gia;
        else $thang_danh_gia = '0' . $request->thang_danh_gia;
        $nam_danh_gia = $request->nam_danh_gia;
        $ma_phieu_danh_gia = $nam_danh_gia . $thang_danh_gia . Auth::user()->so_hieu_cong_chuc;

        //Kiểm tra Mã phiếu đánh giá đã tồn tại
        if (PhieuDanhGia::where('ma_phieu_danh_gia', $ma_phieu_danh_gia)->exists()) {
            return back()->with('msg_error', 'Đã tồn tại kết quả đánh giá của tháng này');
        } else {
            //Tính Tổng điểm cá nhân tự chấm
            $tc_110 = $request->tc_111 + $request->tc_112 + $request->tc_113 + $request->tc_114;
            $tc_130 = $request->tc_131 + $request->tc_132 + $request->tc_133 + $request->tc_134;
            $tc_150 = $request->tc_151 + $request->tc_152 + $request->tc_153 + $request->tc_154;
            $tc_170 = $request->tc_171 + $request->tc_172 + $request->tc_173;
            $tc_100 = $tc_110 + $tc_130 + $tc_150 + $tc_170;
            $tc_210 = $request->tc_211 + $request->tc_212 + $request->tc_213 + $request->tc_214 + $request->tc_215
                + $request->tc_216 + $request->tc_217 + $request->tc_218 + $request->tc_219 + $request->tc_220;
            $tc_230 =  $request->tc_230;
            $tc_200 = $tc_210 + $tc_230;
            $tc_300 = $tc_100 + $tc_200;
            $tc_400 = $request->tc_400;
            $tc_500 = $request->tc_500;
            $tong_diem_tu_cham = $tc_300 + $tc_400 - $tc_500;

            //Tạo mới Phiếu đánh giá
            $phieu_danh_gia = new PhieuDanhGia();
            $phieu_danh_gia->ma_phieu_danh_gia = $ma_phieu_danh_gia;
            $phieu_danh_gia->thoi_diem_danh_gia = $nam_danh_gia . $thang_danh_gia;
            $phieu_danh_gia->so_hieu_cong_chuc = Auth::user()->so_hieu_cong_chuc;
            $phieu_danh_gia->ma_chuc_vu = Auth::user()->ma_chuc_vu;
            $phieu_danh_gia->ma_phong = Auth::user()->ma_phong;
            $phieu_danh_gia->ma_don_vi = Auth::user()->ma_don_vi;
            $phieu_danh_gia->tong_diem_tu_cham = $tong_diem_tu_cham;
            $phieu_danh_gia->ma_trang_thai = 11;
            $phieu_danh_gia->save();

            return back()->with('msg_success', 'Đã gửi thành công Phiếu đánh giá');
        }
    }
}
