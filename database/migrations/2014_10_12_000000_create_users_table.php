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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('so_hieu_cong_chuc')->unique();
            $table->string('name');
            $table->date('ngay_sinh');
            $table->boolean('gioi_tinh');
            $table->string('ma_so_ngach');
            $table->tinyInteger('id_chuc_vu');
            $table->tinyInteger('id_phong');
            $table->tinyInteger('id_don_vi');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
