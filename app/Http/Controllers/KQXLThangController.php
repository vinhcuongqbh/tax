<?php

namespace App\Http\Controllers;

use App\Models\KQXLThang;
use Illuminate\Http\Request;

class KQXLThangController extends Controller
{
    public function create() {
        $kqxl_thang = new KQXLThang();
    }
}
