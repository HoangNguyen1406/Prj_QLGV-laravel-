<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lop_hoc_phans', function (Blueprint $table) {
            $table->id();
            $table->string('ma_lop')->unique();
            $table->string('ten_lop');
            $table->string('giang_vien');
            $table->integer('so_tin_chi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lop_hoc_phans');
    }
};