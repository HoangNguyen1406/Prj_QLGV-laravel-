<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('mssv', 8)->nullable(false)->default('00000000')->change();
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('mssv', 8)->nullable()->change();
        });
    }
};
