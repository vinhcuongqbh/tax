<?php

namespace App\Http\Controllers;

use App\Models\Mau01A;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DanhGiaController extends Controller
{
    public function mau01A() {
        $mau_danh_gia = Mau01A::all();        
        $thoi_diem_danh_gia = Carbon::now()->subMonth();
        $user = User::where('so_hieu_cong_chuc', Auth::user()->so_hieu_cong_chuc)
            ->leftjoin('chuc_vu','chuc_vu.ma_chuc_vu', 'users.ma_chuc_vu')
            ->leftjoin('don_vi','don_vi.ma_don_vi', 'users.ma_don_vi')
            ->select('users.*','chuc_vu.ten_chuc_vu','don_vi.ten_don_vi')
            ->first();

        return view('danhgia.mau01A',
        [
            'mau_danh_gia' => $mau_danh_gia,
            'thoi_diem_danh_gia' => $thoi_diem_danh_gia,
            'user' => $user
        ]);
    }
}
