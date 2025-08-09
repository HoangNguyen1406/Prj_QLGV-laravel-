<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BangDiem extends Model
{
    protected $table = 'bang_diem';
    protected $fillable = [
        'mssv',
        'lop_hoc_phan_id',
        'diem_he_so_1',
        'diem_he_so_2',
        'diem_thuc_hanh'
    ];

     public function sinhVien()
    {
        return $this->belongsTo(Student::class, 'sinh_vien_id');
    }

    public function lopHocPhan()
    {
        return $this->belongsTo(LopHocPhan::class, 'lop_hoc_phan_id');
    }
}

