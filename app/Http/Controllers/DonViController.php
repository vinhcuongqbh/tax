<?php

namespace App\Http\Controllers;

use App\Models\DonVi;
use Illuminate\Http\Request;

class DonViController extends Controller
{
    public function index()
    {
        //Hiển thị danh sách Tài khoản đang sử dụng
        $don_vi = DonVi::join('don_vi as dv2', 'dv2.ma_don_vi', 'don_vi.ma_don_vi')
            ->select('don_vi.*','dv2.ten_don_vi')
            ->get();

        return view('donvi.index', ['don_vi' => $don_vi]);
    }
}
