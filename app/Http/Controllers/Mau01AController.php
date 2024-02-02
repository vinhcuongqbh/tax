<?php

namespace App\Http\Controllers;

use App\Models\Mau01A;
use Illuminate\Http\Request;

class Mau01AController extends Controller
{
    //Tạo mới Đánh giá, xếp loại
    public function create()
    {
        $mau_danh_gia = Mau01A::all();

        return view('danhgia.create', ['mau_danh_gia' => $mau_danh_gia]);
    }
}
