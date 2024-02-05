<?php

namespace App\Http\Controllers;

use App\Models\Mau01A;
use Illuminate\Http\Request;

class DanhGiaController extends Controller
{
    public function mau01A() {
        $mau_danh_gia = Mau01A::all();
        return view('danhgia.mau01A',['mau_danh_gia' => $mau_danh_gia]);
    }
}
