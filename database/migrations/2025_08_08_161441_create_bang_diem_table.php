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
        Schema::create('bang_diem', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mssv')->constrained('students')->onDelete('cascade');
            $table->foreignId('lop_hoc_phan_id')->constrained('lop_hoc_phans')->onDelete('cascade');

            $table->decimal('diem_he_so_1', 5, 2)->nullable(); // Điểm chuyên cần
            $table->decimal('diem__he_so_2', 5, 2)->nullable(); // Điểm giữa kỳ
            $table->decimal('diem_thuc_hanh', 5, 2)->nullable(); // Điểm cuối kỳ

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bang_diem');
    }
};
