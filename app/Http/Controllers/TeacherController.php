<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    protected $db;

    function __construct(){
        $this->db = DB::table('teachers');
    }

    function index(){
        $getInfo = $this->db->where('id',1)->first();
        return view('ThongTinGV.content',compact('getInfo'));
    }
}
