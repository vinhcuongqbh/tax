<?php

namespace App\Http\Controllers;

use App\Models\DonVi;
use Illuminate\Http\Request;

class DonViController extends Controller
{
    public function index()
    {
        //Hiển thị danh sách Tài khoản đang sử dụng
        $don_vi = DonVi::all();

        return view('donvi.index', ['don_vi' => $don_vi]);
    }
}
