<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\DiemDanh;
use App\Models\Dot;
use App\Models\LopHocPhan;
use Illuminate\Support\Facades\Log;

class DiemDanhController extends Controller
{
    public function index(Request $request)
    {
        try {
            $dsDot = Dot::all();
            $dsLopHocPhan = LopHocPhan::all();

            $dot = $request->input('dot');
            $ngay = $request->input('ngay');
            $lopHocPhan = $request->input('lop_hoc_phan');

            $sinhViens = collect();
            $diemDanhData = collect();

            if ($ngay && $lopHocPhan) {
                $sinhViens = Student::where('lop_hoc_phan_id', $lopHocPhan)->get();
                
                if ($sinhViens->isNotEmpty()) {
                    $diemDanhRecords = DiemDanh::where('ngay_diem_danh', $ngay)
                        ->whereIn('student_id', $sinhViens->pluck('id'))
                        ->get();
                    
                    $diemDanhData = $diemDanhRecords->keyBy('student_id');
                }
            }

            // Xử lý response cho AJAX
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'html' => view('DiemDanh.partials.results', [
                        'sinhViens' => $sinhViens,
                        'diemDanhData' => $diemDanhData,
                        'ngay' => $ngay,
                        'dot' => $dot,
                        'lopHocPhan' => $lopHocPhan
                    ])->render()
                ]);
            }

            return view('DiemDanh.index', [
                'dsDot' => $dsDot,
                'dsLopHocPhan' => $dsLopHocPhan,
                'dot' => $dot,
                'ngay' => $ngay,
                'lopHocPhan' => $lopHocPhan,
                'sinhViens' => $sinhViens,
                'diemDanhData' => $diemDanhData,
            ]);
        } catch (\Exception $e) {
            Log::error('DiemDanhController Error: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lỗi khi tải dữ liệu'
                ], 500);
            }
            
            abort(500, 'Lỗi hệ thống');
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'ngay' => 'required|date',
                'lopHocPhan' => 'required|exists:lop_hoc_phans,id',
                'dot' => 'nullable|exists:dots,id',
                'trang_thai' => 'required|array',
                'nhap_so_tiet' => 'sometimes|array',
                'ghi_chu' => 'sometimes|array',
            ]);

            $trangThais = $validated['trang_thai'];
            $soTiets = $validated['nhap_so_tiet'] ?? [];
            $ghiChus = $validated['ghi_chu'] ?? [];
            $ngay = $validated['ngay'];
            $lopHocPhan = $validated['lopHocPhan'];
            $dot = $validated['dot'] ?? null;

            foreach ($trangThais as $studentId => $trangThai) {
                $data = [
                    'student_id' => $studentId,
                    'ngay_diem_danh' => $ngay,
                    'co_mat' => $trangThai === 'co_mat',
                    'vang_co_phep' => $trangThai === 'vang_co_phep',
                    'vang_khong_phep' => $trangThai === 'vang_khong_phep',
                    'nhap_so_tiet' => $soTiets[$studentId] ?? 1,
                    'ghi_chu' => $ghiChus[$studentId] ?? '',
                ];

                DiemDanh::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'ngay_diem_danh' => $ngay,
                    ],
                    $data
                );
            }

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Đã lưu điểm danh thành công.',
                    'redirect' => route('diem-danh.index', [
                        'dot' => $dot,
                        'ngay' => $ngay,
                        'lop_hoc_phan' => $lopHocPhan,
                    ])
                ]);
            }

            return redirect()->route('diem-danh.index', [
                'dot' => $dot,
                'ngay' => $ngay,
                'lop_hoc_phan' => $lopHocPhan,
            ])->with('success', 'Đã lưu điểm danh thành công.');

        } catch (\Exception $e) {
            Log::error('DiemDanhController@store Error: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lỗi khi lưu điểm danh: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->withInput()->with('error', 'Lỗi khi lưu điểm danh');
        }
    }
}