<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Meeting;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class AdminJurusanController extends Controller
{
    public function index()
    {
        return view('admin_jurusan.index');
    }

    public function agenda()
    {
        $today = Carbon::today();

        $data = [
            'meetings' => Meeting::all(),
            'meetings_today' => Meeting::whereDate('date', $today)->get(),
            'meetings_archive' => Meeting::where('date', '<', $today)->get(),
            'meetings_schedule' => Meeting::where('date', '>', $today)->get(),
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


    public function presensi($hashid)
    {
        // Decode the hashed ID
        try {
            $id = Crypt::decryptString(hex2bin($hashid));
        } catch (\Exception $e) {
            return abort(404);
        }

        $data = [
            'meeting' => Meeting::findOrFail($id),
        ];

        return view('admin_jurusan.presensi', $data);
    }

    public function presensiStore(Request $request, $hashid)
    {
        // Decode the hashed ID
        try {
            $id = Crypt::decryptString(hex2bin($hashid));
        } catch (\Exception $e) {
            return abort(404);
        }

        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'position' => 'required|max:255',
            'signature' => 'required|string',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'position.required' => 'Jabatan harus diisi.',
            'position.max' => 'Jabatan tidak boleh lebih dari 255 karakter.',
            'signature.required' => 'Tanda tangan harus diisi.',
        ]);

        try {
            // Simpan tanda tangan sebagai gambar
            $signature = $validatedData['signature'];
            $signature = str_replace('data:image/png;base64,', '', $signature);
            $signature = str_replace(' ', '+', $signature);
            $imageName = $validatedData['name'] . '_' . time() . '.png';
            Storage::disk('public')->put($imageName, base64_decode($signature));

            // Buat dan simpan partisipan
            $participant = Participant::create([
                'meeting_id' => $id,
                'name' => $validatedData['name'],
                'position' => $validatedData['position'],
                'signature' => $imageName,
            ]);

            if ($participant) {
                return redirect()->route('presensi.peserta', ['hashid' => $hashid])->with('success', 'Presensi berhasil disimpan.');
            } else {
                return redirect()->route('presensi.peserta', ['hashid' => $hashid])->with('error', 'Gagal menyimpan presensi.');
            }
        } catch (\Exception $e) {
            return redirect()->route('presensi.peserta', ['hashid' => $hashid])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function agendaToday()
    {
        $today = Carbon::today();

        $data = [
            'meetings_today' => Meeting::whereDate('date', $today)->get(),
        ];
        return view('admin_jurusan.agenda_today', $data);
    }

    public function agendaSchedule()
    {
        $today = Carbon::today();

        $data = [
            'meetings_schedule' => Meeting::where('date', '>', $today)->get(),
        ];
        return view('admin_jurusan.agenda_schedule', $data);
    }

    public function agendaArchive()
    {
        $today = Carbon::today();

        $data = [
            'meetings_archive' => Meeting::where('date', '<', $today)->get(),
        ];

        return view('admin_jurusan.agenda_archive', $data);
    }

    public function minutes($id)
    {
        $data = [
            'meeting' => Meeting::findOrFail($id),
        ];

        return view('admin_jurusan.minutes', $data);
    }
}
