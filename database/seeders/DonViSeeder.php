<?php

namespace Database\Seeders;

use App\Models\DonVi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonViSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $don_vi = [
            [
                'ma_don_vi' => '4400',
                'ten_don_vi' => 'Cục Thuế tỉnh Quảng Bình',
                'ma_don_vi_cap_tren' => null,
                'id_trang_thai' => 1,
            ],
            [
                'ma_don_vi' => '4401',
                'ten_don_vi' => 'Cơ quan Văn phòng Cục Thuế',
                'ma_don_vi_cap_tren' => '4400',
                'id_trang_thai' => 1,
            ],
            [
                'ma_don_vi' => '4402',
                'ten_don_vi' => 'Chi cục Thuế khu vực Đồng Hới - Quảng Ninh',
                'ma_don_vi_cap_tren' => '4400',
                'id_trang_thai' => 1,
            ],
            [
                'ma_don_vi' => '4403',
                'ten_don_vi' => 'Chi cục Thuế khu vực Tuyên Hóa - Minh Hóa',
                'ma_don_vi_cap_tren' => '4400',
                'id_trang_thai' => 1,
            ],
            [
                'ma_don_vi' => '4405',
                'ten_don_vi' => 'Chi cục Thuế khu vực Quảng Trạch - Ba Đồn',
                'ma_don_vi_cap_tren' => '4400',
                'id_trang_thai' => 1,
            ],
            [
                'ma_don_vi' => '4406',
                'ten_don_vi' => 'Chi cục Thuế Huyện Bố Trạch',
                'ma_don_vi_cap_tren' => '4400',
                'id_trang_thai' => 1,
            ],
            [
                'ma_don_vi' => '4408',
                'ten_don_vi' => 'Chi cục Thuế Huyện Lệ Thuỷ',
                'ma_don_vi_cap_tren' => '4400',
                'id_trang_thai' => 1,
            ],
        ];
        DonVi::insert($don_vi);
    }
}
