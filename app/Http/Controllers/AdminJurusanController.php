<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminJurusanController extends Controller
{
    public function index()
    {
        return view('admin_jurusan.index');
    }

    public function agenda(){
        return view('admin_jurusan.agenda');
    }
}
