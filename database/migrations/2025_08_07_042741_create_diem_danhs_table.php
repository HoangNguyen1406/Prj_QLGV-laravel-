<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('diem_danhs', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('student_id'); // Khóa ngoại đến bảng students
        $table->date('ngay_diem_danh'); // Ngày điểm danh
        $table->boolean('co_mat')->default(false); // Có mặt
        $table->boolean('vang_co_phep')->default(false); // Vắng có phép
        $table->boolean('vang_khong_phep')->default(false); // Vắng không phép
        $table->boolean('nhap_so_tiet')->default(false); // Nhập số tiết
        $table->string('ghi_chu')->nullable(); // Ghi chú
        $table->timestamps();

        $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diem_danhs');
    }
};
