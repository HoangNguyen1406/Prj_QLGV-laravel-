<?php

namespace Database\Seeders;

use App\Models\Dot;
use Illuminate\Database\Seeder;

class DotSeeder extends Seeder
{
    public function run()
    {
        $dots = [
            [
                'ten_dot' => 'HK1 2023-2024',
                'ngay_bat_dau' => '2023-08-15',
                'ngay_ket_thuc' => '2023-12-20',
                'mo_ta' => 'Học kỳ 1 năm học 2023-2024'
            ],
            [
                'ten_dot' => 'HK2 2023-2024',
                'ngay_bat_dau' => '2024-01-08',
                'ngay_ket_thuc' => '2024-05-15',
                'mo_ta' => 'Học kỳ 2 năm học 2023-2024'
            ],
            [
                'ten_dot' => 'Hè 2024',
                'ngay_bat_dau' => '2024-06-01',
                'ngay_ket_thuc' => '2024-08-15',
                'mo_ta' => 'Khóa học hè 2024'
            ]
        ];

        foreach ($dots as $dot) {
            Dot::create($dot);
        }
    }
}
