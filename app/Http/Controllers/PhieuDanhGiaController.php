<?php

namespace App\Http\Controllers;

use App\Models\KetQuaMucA;
use App\Models\KetQuaMucB;
use App\Models\LyDoDiemCong;
use App\Models\LyDoDiemTru;
use App\Models\Mau01A;
use App\Models\Mau01B;
use App\Models\Mau01C;
use App\Models\PhieuDanhGia;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PhieuDanhGiaController extends Controller
{
    //Tạo Phiếu đánh giá tự chấm
    public function taophieudanhgia()
    {
        $thoi_diem_danh_gia = Carbon::now()->subMonth();
        $user = User::where('so_hieu_cong_chuc', Auth::user()->so_hieu_cong_chuc)
            ->leftjoin('chuc_vu', 'chuc_vu.ma_chuc_vu', 'users.ma_chuc_vu')
            ->leftjoin('don_vi', 'don_vi.ma_don_vi', 'users.ma_don_vi')
            ->select('users.*', 'chuc_vu.ten_chuc_vu', 'don_vi.ten_don_vi')
            ->first();

        if (Auth::user()->ma_chuc_vu != NULL) {
            $mau_phieu_danh_gia = Mau01A::all();
            return view(
                'danhgia.mau01A_create',
                [
                    'mau_phieu_danh_gia' => $mau_phieu_danh_gia,
                    'thoi_diem_danh_gia' => $thoi_diem_danh_gia,
                    'user' => $user
                ]
            );
        } else {
            $mau_phieu_danh_gia = Mau01B::all();
            return view(
                'danhgia.mau01B_create',
                [
                    'mau_phieu_danh_gia' => $mau_phieu_danh_gia,
                    'thoi_diem_danh_gia' => $thoi_diem_danh_gia,
                    'user' => $user
                ]
            );
        }
    }


    //Lưu Phiếu đánh giá tự chấm
    public function luuphieudanhgia(Request $request)
    {
        //Tạo Mã phiếu đánh giá
        if (($request->thang_danh_gia == '11') || ($request->thang_danh_gia == '12')) $request->thang_danh_gia;
        else $thang_danh_gia = '0' . $request->thang_danh_gia;
        $nam_danh_gia = $request->nam_danh_gia;
        $ma_phieu_danh_gia = $nam_danh_gia . $thang_danh_gia . "_" . Auth::user()->so_hieu_cong_chuc;

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


            //Lưu kết quả tự chấm Mục A
            if ($request->mau_phieu_danh_gia == "mau01A") $mau_phieu_danh_gia = Mau01A::all();
            elseif ($request->mau_phieu_danh_gia == "mau01B") $mau_phieu_danh_gia = Mau01B::all();
            else $mau_phieu_danh_gia = Mau01C::all();
            foreach ($mau_phieu_danh_gia as $mau_phieu_danh_gia) {
                $ket_qua_muc_A = new KetQuaMucA();
                $ket_qua_muc_A->ma_phieu_danh_gia = $ma_phieu_danh_gia;
                $ket_qua_muc_A->ma_tieu_chi = $mau_phieu_danh_gia->ma_tieu_chi;
                $ket_qua_muc_A->diem_toi_da = $mau_phieu_danh_gia->diem_toi_da;
                $ket_qua_muc_A->diem_tu_cham = $request->input($mau_phieu_danh_gia->ma_tieu_chi);
                $ket_qua_muc_A->save();
            }

            //Lưu kết quả tự chấm Mục B    
            for ($i = 1; $i <= 50; $i++) {
                if ($request->input($i . '_noi_dung_nhiem_vu') != null) {
                    $ket_qua_muc_B = new KetQuaMucB();
                    $ket_qua_muc_B->ma_phieu_danh_gia = $ma_phieu_danh_gia;
                    $ket_qua_muc_B->noi_dung = $request->input($i . '_noi_dung_nhiem_vu');
                    $ket_qua_muc_B->nhiem_vu_phat_sinh = $request->input($i . '_nhiem_vu_phat_sinh');
                    $ket_qua_muc_B->hoan_thanh_nhiem_vu = $request->input($i . '_hoan_thanh_nhiem_vu');
                    $ket_qua_muc_B->save();
                };
            }

            //Lưu kết quả Lý do điểm Cộng
            $ly_do_diem_cong = new LyDoDiemCong();
            $ly_do_diem_cong->ma_phieu_danh_gia = $ma_phieu_danh_gia;
            $ly_do_diem_cong->noi_dung = $request->ly_do_diem_cong;
            $ly_do_diem_cong->save();

            //Lưu kết quả Lý do điểm trừ
            $ly_do_diem_tru = new LyDoDiemTru();
            $ly_do_diem_tru->ma_phieu_danh_gia = $ma_phieu_danh_gia;
            $ly_do_diem_tru->noi_dung = $request->ly_do_diem_tru;
            $ly_do_diem_tru->save();

            //Lưu kết quả Phiếu đánh giá
            $phieu_danh_gia = new PhieuDanhGia();
            $phieu_danh_gia->mau_phieu_danh_gia = $request->mau_phieu_danh_gia;
            $phieu_danh_gia->ma_phieu_danh_gia = $ma_phieu_danh_gia;
            $phieu_danh_gia->thoi_diem_danh_gia = $nam_danh_gia . $thang_danh_gia;
            $phieu_danh_gia->so_hieu_cong_chuc = Auth::user()->so_hieu_cong_chuc;
            $phieu_danh_gia->ma_chuc_vu = Auth::user()->ma_chuc_vu;
            $phieu_danh_gia->ma_phong = Auth::user()->ma_phong;
            $phieu_danh_gia->ma_don_vi = Auth::user()->ma_don_vi;
            $phieu_danh_gia->tong_diem_tu_cham = $tong_diem_tu_cham;
            $phieu_danh_gia->ca_nhan_tu_xep_loai = $request->tu_danh_gia;
            $phieu_danh_gia->ma_trang_thai = 11;
            $phieu_danh_gia->save();

            return back()->with('msg_success', 'Đã gửi thành công Phiếu đánh giá');
        }
    }


    public function xemphieudanhgia($id)
    {
        $phieu_danh_gia = PhieuDanhGia::where('ma_phieu_danh_gia', $id)->first();
        if ($phieu_danh_gia->mau_phieu_danh_gia == 'mau01A') {
            $ket_qua_muc_A = KetQuaMucA::where('ma_phieu_danh_gia', $id)
                ->leftjoin('mau01A', 'mau01A.ma_tieu_chi', 'ket_qua_muc_A.ma_tieu_chi')
                ->select('ket_qua_muc_A.*', 'mau01A.tieu_chi_me', 'mau01A.loai_tieu_chi', 'mau01A.tt', 'mau01A.noi_dung')
                ->get();
        } elseif ($phieu_danh_gia->mau_phieu_danh_gia == 'mau01B') {
            $ket_qua_muc_A = KetQuaMucA::where('ma_phieu_danh_gia', $id)
                ->leftjoin('mau01B', 'mau01B.ma_tieu_chi', 'ket_qua_muc_A.ma_tieu_chi')
                ->select('ket_qua_muc_A.*', 'mau01B.tieu_chi_me', 'mau01B.loai_tieu_chi', 'mau01B.tt', 'mau01B.noi_dung')
                ->get();
        } else {
            $ket_qua_muc_A = KetQuaMucA::where('ma_phieu_danh_gia', $id)
                ->leftjoin('mau01C', 'mau01C.ma_tieu_chi', 'ket_qua_muc_A.ma_tieu_chi')
                ->select('ket_qua_muc_A.*', 'mau01C.tieu_chi_me', 'mau01C.loai_tieu_chi', 'mau01C.tt', 'mau01C.noi_dung')
                ->get();
        }
        $ket_qua_muc_B = KetQuaMucB::where('ma_phieu_danh_gia', $id)->get();
        $ly_do_diem_cong = LyDoDiemCong::where('ma_phieu_danh_gia', $id)->first();
        $ly_do_diem_tru = LyDoDiemTru::where('ma_phieu_danh_gia', $id)->first();

        $user = User::where('so_hieu_cong_chuc', Auth::user()->so_hieu_cong_chuc)
            ->leftjoin('chuc_vu', 'chuc_vu.ma_chuc_vu', 'users.ma_chuc_vu')
            ->leftjoin('don_vi', 'don_vi.ma_don_vi', 'users.ma_don_vi')
            ->select('users.*', 'chuc_vu.ten_chuc_vu', 'don_vi.ten_don_vi')
            ->first();

        if ($phieu_danh_gia->mau_phieu_danh_gia == 'mau01A') {
            return view(
                'danhgia.mau01A_show',
                [
                    'mau_phieu_danh_gia' => $phieu_danh_gia,
                    'user' => $user,
                    'ket_qua_muc_A' => $ket_qua_muc_A,
                    'ket_qua_muc_B' => $ket_qua_muc_B,
                    'ly_do_diem_cong' => $ly_do_diem_cong,
                    'ly_do_diem_tru' => $ly_do_diem_tru,
                ]
            );
        } elseif ($phieu_danh_gia->mau_phieu_danh_gia == 'mau01B') {
            return view(
                'danhgia.mau01B_show',
                [
                    'mau_phieu_danh_gia' => $phieu_danh_gia,
                    'user' => $user,
                    'ket_qua_muc_A' => $ket_qua_muc_A,
                    'ket_qua_muc_B' => $ket_qua_muc_B,
                    'ly_do_diem_cong' => $ly_do_diem_cong,
                    'ly_do_diem_tru' => $ly_do_diem_tru,
                ]
            );
        } else return view(
            'danhgia.mau01C_show',
            [
                'mau_phieu_danh_gia' => $phieu_danh_gia,
                'user' => $user,
                'ket_qua_muc_A' => $ket_qua_muc_A,
                'ket_qua_muc_B' => $ket_qua_muc_B,
                'ly_do_diem_cong' => $ly_do_diem_cong,
                'ly_do_diem_tru' => $ly_do_diem_tru,
            ]
        );
    }


    public function danhsachtudanhgia()
    {
        $danh_sach_tu_danh_gia = PhieuDanhGia::where('phieu_danh_gia.so_hieu_cong_chuc', Auth::user()->so_hieu_cong_chuc)
            ->leftjoin('users', 'users.so_hieu_cong_chuc', 'phieu_danh_gia.so_hieu_cong_chuc')
            ->leftjoin('chuc_vu', 'chuc_vu.ma_chuc_vu', 'phieu_danh_gia.ma_chuc_vu')
            ->leftjoin('phong', 'phong.ma_phong', 'phieu_danh_gia.ma_phong')
            ->leftjoin('don_vi', 'don_vi.ma_don_vi', 'phieu_danh_gia.ma_don_vi')
            ->select('phieu_danh_gia.*', 'users.name', 'chuc_vu.ten_chuc_vu', 'phong.ten_phong', 'don_vi.ten_don_vi')
            ->orderBy('phieu_danh_gia.ma_phieu_danh_gia', 'DESC')
            ->get();

        return view('danhgia.danhsachtudanhgia', ['danh_sach_tu_danh_gia' => $danh_sach_tu_danh_gia]);
    }
}
