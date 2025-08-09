<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiemDanh extends Model
{
    use HasFactory;

    protected $table = 'diem_danhs';

    protected $fillable = [
        'student_id',
        'ngay_diem_danh',
        'co_mat',
        'vang_co_phep',
        'vang_khong_phep',
        'nhap_so_tiet',
        'ghi_chu',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
