<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->foreignId('lop_hoc_phan_id')
                  ->nullable()
                  ->constrained('lop_hoc_phans')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['lop_hoc_phan_id']);
            $table->dropColumn('lop_hoc_phan_id');
        });
    }
};