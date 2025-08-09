<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\LopHocPhan;
use App\Models\BangDiem;
use App\Models\Dot;

class NhapDiemController extends Controller
{
    // Hiển thị form nhập điểm
    public function index(Request $request)
    {
        // Lấy danh sách đợt 
        $dsDot = Dot::all();

        // Lấy danh sách lớp học phần
        $lopHocPhans = LopHocPhan::all();

        // Lấy danh sách sinh viên theo điều kiện lọc
        $sinhViens = collect();
        $lopHocPhanId = $request->input('lop_hoc_phan_id');

        return view('NhapDiem.index', compact(
            'dsDot',
            'lopHocPhans',
            'sinhViens',
            'lopHocPhanId'
        ));
    }

    // Lưu điểm
    public function store(Request $request)
    {
        $lt_hs1 = $request->input('diem_he_so_1', []);
        $lt_hs2 = $request->input('diem_he_so_2', []);
        $thuc_hanh = $request->input('diem-thuc_hanh', []);

        foreach ($lt_hs1 as $svId => $diem1) {
            BangDiem::updateOrCreate(
                [
                    'sinh_vien_id' => $svId,
                    'lop_hoc_phan_id' => $request->input('lop_hoc_phan_id'),
                ],
                [
                    'diem_he_so_1' => $diem1,
                    'diem_he_so_2' => $lt_hs2[$svId] ?? null,
                    'diem_thuc_hanh' => $thuc_hanh[$svId] ?? null,
                ]
            );
        }

        return redirect()->route('nhap-diem.index')->with('success', 'Lưu điểm thành công');
    }
}
