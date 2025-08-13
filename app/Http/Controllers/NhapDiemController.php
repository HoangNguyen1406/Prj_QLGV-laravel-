<?php

namespace App\Http\Controllers;

use App\Models\Dot;
use App\Models\LopHocPhan;
use App\Models\Student;
use App\Models\BangDiem;
use Illuminate\Http\Request;

class NhapDiemController extends Controller
{
    public function index(Request $request)
    {
        // Lấy danh sách đợt và lớp học phần
        $dsDot = Dot::all();
        $lopHocPhans = LopHocPhan::all();
        $sinhViens = collect(); // mặc định rỗng
        $lopHocPhanId = null;

        // Nếu người dùng tìm kiếm
        if ($request->filled('dot') && $request->filled('ma_lop')) {
            // Tìm lớp học phần ứng với mã lớp và đợt
            $lopHocPhan = LopHocPhan::where('ma_lop', $request->ma_lop)
                ->first();

            if ($lopHocPhan) {
                $lopHocPhanId = $lopHocPhan->id;

                // Lấy danh sách sinh viên kèm điểm
                $sinhViens = Student::where('lop_hoc_phan_id', $lopHocPhanId)
                    ->with(['diem' => function ($q) use ($lopHocPhanId) {
                        $q->where('lop_hoc_phan_id', $lopHocPhanId);
                    }])
                    ->get();
            }
        }

        return view('NhapDiem.index', [
            'dsDot'         => $dsDot,
            'lopHocPhans'   => $lopHocPhans,
            'sinhViens'     => $sinhViens,
            'lopHocPhanId'  => $lopHocPhanId
        ]);
    }

    public function store(Request $request)
    {
        $mssvList = $request->input('mssv', []);
        $lopHocPhanId = $request->input('lop_hoc_phan_id');

        foreach ($mssvList as $key => $mssv) {
            BangDiem::updateOrCreate(
                [
                    'mssv' => $mssv,
                    'lop_hoc_phan_id' => $lopHocPhanId
                ],
                [
                    'diem_he_so_1'   => $request->input('diem_he_so_1')[$key] ?? null,
                    'diem_he_so_2'   => $request->input('diem_he_so_2')[$key] ?? null,
                    'diem_thuc_hanh' => $request->input('diem_thuc_hanh')[$key] ?? null
                ]
            );
        }

        return redirect()->route('nhap-diem.index')
            ->with('success', 'Lưu điểm thành công');
    }
}
