<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    protected $db;

    function __construct(){
        $this->db = DB::table('teachers');
    }

    function index(){
        $id = Auth::user()->id_teacher;
        $getInfo = $this->db->where('id',$id)->first();
        return view('ThongTinGV.content',compact('getInfo'));
    }
}
