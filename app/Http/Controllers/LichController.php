<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LichController extends Controller
{
    protected $db;

    function __construct(){
        $this->db = DB::table('lich_days');
    }

    function index(){
        $startWeek = Carbon::now()->startOfWeek()->format('d/m/Y');
        $now = Carbon::now()->format('Y-m-d');
        $days = [];

        for ($i = 0; $i < 7; $i++) {
            $days[$i] = Carbon::now()->startOfWeek()->copy()->addDays($i)->format('d/m/Y');
        }

        $getInfo = $this->db->where('id', 1)->first();
        return view('lich.index',compact('getInfo','startWeek','days','now'));
    }
}
