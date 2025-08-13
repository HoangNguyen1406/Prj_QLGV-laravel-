<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function lopHocPhans()
    {
        return $this->belongsToMany(LopHocPhan::class, 'id', 'ma_lop', 'ten_lop', 'giang_vien', 'so_tin_chi',);
    }

    public function diem()
    {
        return $this->hasOne(BangDiem::class, 'mssv', 'mssv');
    }

    protected $table = 'students';
    protected $fillable = ['id', 'mssv', 'Name', 'Gender', 'classroom','lop_hoc_phan_id'];
}
