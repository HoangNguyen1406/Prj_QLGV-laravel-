<?php

namespace Database\Seeders;

use App\Models\LopHocPhan;
use Illuminate\Database\Seeder;

class LopHocPhanSeeder extends Seeder
{
    public function run()
    {
        $lops = [
            [
                'ma_lop' => 'CTK42',
                'ten_lop' => 'Lập trình Web với Laravel',
                'giang_vien' => 'Nguyễn Văn A',
                'so_tin_chi' => 3
            ],
            [
                'ma_lop' => 'CTK43',
                'ten_lop' => 'Cơ sở dữ liệu nâng cao',
                'giang_vien' => 'Trần Thị B',
                'so_tin_chi' => 4
            ],
            [
                'ma_lop' => 'CTK44',
                'ten_lop' => 'Phát triển ứng dụng di động',
                'giang_vien' => 'Lê Văn C',
                'so_tin_chi' => 3
            ]
        ];

        foreach ($lops as $lop) {
            LopHocPhan::create($lop);
        }
    }
}
