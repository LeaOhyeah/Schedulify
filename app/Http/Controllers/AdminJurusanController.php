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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'activity' => 'required|max:255',
            'pic' => 'required|max:255',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'location' => 'required|max:255',
        ], [
            'activity.required' => 'Aktivitas harus diisi.',
            'activity.max' => 'Aktivitas tidak boleh lebih dari 255 karakter.',
            'pic.required' => 'Penanggung jawab harus diisi.',
            'pic.max' => 'Penanggung jawab tidak boleh lebih dari 255 karakter.',
            'date.required' => 'Tanggal harus diisi.',
            'date.date' => 'Tanggal tidak valid.',
            'start_time.required' => 'Waktu mulai harus diisi.',
            'start_time.date_format' => 'Waktu mulai harus dalam format jam:menit (HH:MM).',
            'end_time.date_format' => 'Waktu selesai harus dalam format jam:menit (HH:MM).',
            'location.required' => 'Lokasi harus diisi.',
            'location.max' => 'Lokasi tidak boleh lebih dari 255 karakter.',
        ]);
        $validatedData['user_id'] = auth()->user()->id;

        if (Meeting::create($validatedData)) {
            return redirect()->route('agenda.index')->with('success', 'Data berhasil ditambahkan!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }

    public function edit($id)
    {
        $data = [
            'meeting' => Meeting::findOrFail($id)
        ];

        return view('admin_jurusan.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'activity' => 'required|max:255',
            'pic' => 'required|max:255',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'location' => 'required|max:255',
        ], [
            'activity.required' => 'Aktivitas harus diisi.',
            'activity.max' => 'Aktivitas tidak boleh lebih dari 255 karakter.',
            'pic.required' => 'Penanggung jawab harus diisi.',
            'pic.max' => 'Penanggung jawab tidak boleh lebih dari 255 karakter.',
            'date.required' => 'Tanggal harus diisi.',
            'date.date' => 'Tanggal tidak valid.',
            'start_time.required' => 'Waktu mulai harus diisi.',
            'start_time.date_format' => 'Waktu mulai harus dalam format jam:menit (HH:MM).',
            'end_time.date_format' => 'Waktu selesai harus dalam format jam:menit (HH:MM).',
            'location.required' => 'Lokasi harus diisi.',
            'location.max' => 'Lokasi tidak boleh lebih dari 255 karakter.',
        ]);

        $meeting = Meeting::findOrFail($id);

        if ($meeting->user_id == auth()->user()->id && $meeting->update($validatedData)) {
            return back()->with('success', 'Data berhasil diperbarui!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }

    public function destroy($id)
    {
        $agenda = Meeting::findOrFail($id);
        $agenda->delete();
        return redirect()->route('agenda.index')->with('success', 'Data berhasil dihapus!');
    }
}
