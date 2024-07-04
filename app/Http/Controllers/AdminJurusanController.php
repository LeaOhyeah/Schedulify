<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;

class AdminJurusanController extends Controller
{
    public function index()
    {
        return view('admin_jurusan.index');
    }

    public function agenda()
    {
        $data = [
            'meetings' => Meeting::all(),
        ];

        return view('admin_jurusan.agenda', $data);
    }

    public function create()
    {
        return view('admin_jurusan.create');
    }
}
