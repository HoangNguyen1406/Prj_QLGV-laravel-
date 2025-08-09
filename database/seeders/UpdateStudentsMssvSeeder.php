<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema; // Thêm dòng này

class UpdateStudentsMssvSeeder extends Seeder
{
    public function run()
    {
        // Tạm thời cho phép cột mssv null
        Schema::table('students', function ($table) {
            $table->string('mssv', 8)->nullable()->change();
        });

        // Cập nhật MSSV theo classroom
        $classrooms = Student::select('classroom')
                           ->distinct()
                           ->orderBy('classroom')
                           ->get();

        foreach ($classrooms as $class) {
            $yearPrefix = is_numeric(substr($class->classroom, 0, 2)) 
                        ? substr($class->classroom, 0, 2)
                        : '00';

            $students = Student::where('classroom', $class->classroom)
                             ->orderBy('id')
                             ->get();

            $counter = 1;
            foreach ($students as $student) {
                $mssv = $yearPrefix . '00' . str_pad($counter, 4, '0', STR_PAD_LEFT);
                $student->mssv = $mssv;
                $student->save();
                $counter++;
            }
        }

        // Đặt lại NOT NULL sau khi cập nhật xong
        Schema::table('students', function ($table) {
            $table->string('mssv', 8)->nullable(false)->change();
        });

        $this->command->info('Cập nhật MSSV thành công!');
    }
}