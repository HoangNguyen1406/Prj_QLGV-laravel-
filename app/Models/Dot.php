<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dot extends Model
{
    protected $fillable = ['ten_dot', 'ngay_bat_dau', 'ngay_ket_thuc'];
    
    public function diemDanhs()
    {
        return $this->hasMany(DiemDanh::class);
    }
}
