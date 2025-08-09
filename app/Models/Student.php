<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
   public function lopHocPhan()
{
    return $this->belongsTo(LopHocPhan::class)->withoutRelations(); // Tạm ngắt quan hệ đệ quy
}
    protected $table = 'students';
    protected $fillable = ['id', 'mssv', 'Name', 'Gender', 'classroom'];
}
