<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'so_hieu_cong_chuc' => '044089005060',
            'name' => 'Vĩnh Cường',
            'ngay_sinh' => '1989/03/19',
            'gioi_tinh' => '0',
            'ma_so_ngach' => '01.003',
            'id_chuc_vu' => '0',
            'id_phong' => '0',
            'id_don_vi' => '0',
            'email' => 'vtcuong.qbi@gdt.gov.vn',
            'password' => Hash::make('123456'),
        ];
        User::insert($user);
    }
}
