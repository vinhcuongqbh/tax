<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('phieu_danh_gia', function (Blueprint $table) {
            $table->id();
            $table->string('mau_phieu_danh_gia');
            $table->string('ma_phieu_danh_gia')->unique();
            $table->string('thoi_diem_danh_gia');
            $table->string('so_hieu_cong_chuc');            
            $table->string('ma_chuc_vu')->nullable();
            $table->string('ma_phong');
            $table->string('ma_don_vi');            
            $table->tinyInteger('tong_diem_tu_cham');
            $table->tinyInteger('tong_diem_dang_gia')->nullable();
            $table->string('ca_nhan_tu_xep_loai')->nullable();
            $table->string('ket_qua_xep_loai')->nullable();
            $table->tinyInteger('ma_trang_thai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieu_danh_gia');
    }
};
