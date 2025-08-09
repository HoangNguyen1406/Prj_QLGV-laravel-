<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LopHocPhan extends Model
{
    protected $fillable = ['ma_lop', 'ten_lop'];
    
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    
    public function diemDanhs()
    {
        return $this->hasMany(DiemDanh::class);
    }
}
