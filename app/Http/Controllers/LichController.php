<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LichController extends Controller
{
    protected $db;

    function __construct(){
        $this->db = DB::table('lich_days');
    }

    function index(){
        // ID giáo viên hiện tại
        $id = Auth::user()->id_teacher;

        // Lấy tất cả lịch dạy của giáo viên
        $getInfo = $this->db->where('id_teacher', $id)->get();

        // Gom lịch theo ngày + buổi
        $lichday = [];

        foreach($getInfo as $lich){
            $startSession = explode("-", $lich->SoTiet);
            $firstN = (int)$startSession[0];

            if ($firstN >= 1 && $firstN <= 5) {
                $time = "Sáng";
            } elseif ($firstN >= 6 && $firstN <= 12) {
                $time = "Chiều";
            } else {
                $time = "Tối";
            }

            $ngay = date("Y-m-d", strtotime($lich->NgayDay));

            // Có thể nhiều lịch cùng buổi trong 1 ngày → dùng [] thay vì gán =
            $lichday[$ngay][$time][] = $lich;
        }

        return view('lich.index', compact('lichday'));
    }
}
