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
        Schema::create('kqxl_quy', function (Blueprint $table) {
            $table->id();
            $table->string('ma_xep_loai_quy');            
            $table->string('so_hieu_cong_chuc');            
            $table->string('ma_chuc_vu')->nullable();
            $table->string('ma_phong');
            $table->string('ma_don_vi');            
            $table->string('kqxl_quy_1')->nullable();
            $table->string('kqxl_quy_2')->nullable();
            $table->string('kqxl_quy_3')->nullable();
            $table->string('kqxl_quy_4')->nullable(); 
            $table->string('nam');
            $table->tinyInteger('ma_trang_thai')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kqxl_quy');
    }
};
