<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dots', function (Blueprint $table) {
            $table->id();
            $table->string('ten_dot');
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc');
            $table->text('mo_ta')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dots');
    }
};