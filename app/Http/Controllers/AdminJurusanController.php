<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Meeting;
use App\Models\Minutes;
// use Barryvdh\DomPDF\PDF;
use PDF;
use App\Models\Participant;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use PhpOffice\PhpWord\Element\TextRun;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;


class AdminJurusanController extends Controller
{
    public function index()
    {
        return view('admin_jurusan.index');
    }

    public function meetings()
    {
        $data = [
            'meetings' => Meeting::where('user_id', auth()->user()->id)->get(),
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
            return redirect()->route('admin_jurusan.meetings.index')->with('success', 'Data berhasil ditambahkan!');
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
            'start_time' => 'required',
            'end_time' => 'nullable',
            'location' => 'required|max:255',
        ], [
            'activity.required' => 'Aktivitas harus diisi.',
            'activity.max' => 'Aktivitas tidak boleh lebih dari 255 karakter.',
            'pic.required' => 'Penanggung jawab harus diisi.',
            'pic.max' => 'Penanggung jawab tidak boleh lebih dari 255 karakter.',
            'date.required' => 'Tanggal harus diisi.',
            'date.date' => 'Tanggal tidak valid.',
            'start_time.required' => 'Waktu mulai harus diisi.',
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
        return redirect()->route('admin_jurusan.meetings.index')->with('success', 'Data berhasil dihapus!');
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
                return redirect()->route('presensi.peserta', ['hashid' => $hashid])->with('success', 'Anda telah melakukan presensi');
            } else {
                return redirect()->route('presensi.peserta', ['hashid' => $hashid])->with('error', 'Terjadi kesalahan');
            }
        } catch (\Exception $e) {
            return redirect()->route('presensi.peserta', ['hashid' => $hashid])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function meetingsToday()
    {
        $today = Carbon::today();

        $data = [
            'meetings_today' => Meeting::where('user_id', auth()->user()->id)->whereDate('date', $today)->get(),
        ];
        return view('admin_jurusan.agenda_today', $data);
    }

    public function meetingsUpcoming()
    {
        $today = Carbon::today();

        $data = [
            'meetings_schedule' => Meeting::where('user_id', auth()->user()->id)->where('date', '>', $today)->get(),
        ];
        return view('admin_jurusan.agenda_schedule', $data);
    }

    public function meetingsCompleted()
    {
        $today = Carbon::today();

        $data = [
            'meetings_archive' => Meeting::where('user_id', auth()->user()->id)->where('date', '<', $today)->get(),
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

    public function minutesStore(Request $request, $id)
    {
        $validateData = $request->validate([
            'basis' => 'required|max:600',
            'chairperson' => 'required|max:255',
            'minute_taker' => 'required|max:255',
            'method' => 'required|max:255',
            'outcome' => 'required',
        ], [
            'basis.required' => 'Basis wajib diisi.',
            'basis.max' => 'Basis tidak boleh lebih dari 600 karakter.',
            'chairperson.required' => 'Ketua rapat wajib diisi.',
            'chairperson.max' => 'Nama ketua rapat tidak boleh lebih dari 255 karakter.',
            'minute_taker.required' => 'Notulis wajib diisi.',
            'minute_taker.max' => 'Nama notulis tidak boleh lebih dari 255 karakter.',
            'method.required' => 'Metode wajib diisi.',
            'method.max' => 'Metode tidak boleh lebih dari 255 karakter.',
            'outcome.required' => 'Hasil rapat wajib diisi.',
        ]);

        $validateData['meeting_id'] = $id;

        if (Minutes::create($validateData)) {
            return redirect()->route('admin_jurusan.meetings.index')->with('success', 'Notulensi berhasil ditambahkan!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }

    public function minutesEdit($id)
    {
        $meeting = Meeting::findOrFail($id);
        $data = [
            'meeting' => $meeting,
            'minutes' => Minutes::where('meeting_id', $id)->first(),
        ];

        return view('admin_jurusan.minutes_edit', $data);
    }

    public function minutesUpdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'basis' => 'required|max:600',
            'chairperson' => 'required|max:255',
            'minute_taker' => 'required|max:255',
            'method' => 'required|max:255',
            'outcome' => 'required',
        ], [
            'basis.required' => 'Basis wajib diisi.',
            'basis.max' => 'Basis tidak boleh lebih dari 600 karakter.',
            'chairperson.required' => 'Ketua rapat wajib diisi.',
            'chairperson.max' => 'Nama ketua rapat tidak boleh lebih dari 255 karakter.',
            'minute_taker.required' => 'Notulis wajib diisi.',
            'minute_taker.max' => 'Nama notulis tidak boleh lebih dari 255 karakter.',
            'method.required' => 'Metode wajib diisi.',
            'method.max' => 'Metode tidak boleh lebih dari 255 karakter.',
            'outcome.required' => 'Hasil rapat wajib diisi.',
        ]);

        $minutes = Minutes::findOrFail($id);

        if ($minutes->update($validateData)) {
            return back()->with('success', 'Notulensi berhasil diperbarui!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }

    public function printMinutes($id)
    {
        // Path ke template yang Anda buat
        $templatePath = storage_path('app/public/temp.docx');


        // Memuat template
        $templateProcessor = new TemplateProcessor($templatePath);

        // Mengambil data dari database
        $meeting = Meeting::with('minutes')->findOrFail($id);

        // Mengisi placeholder dengan data dari database
        // $templateProcessor->setValue('basis', 'tempora?');

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $wordTable = $section->addTable();
        $wordTable->addRow();
        $cell = $wordTable->addCell();
        Html::addHtml($cell, 'lea');
        $templateProcessor->setComplexBlock('basis', $wordTable);



        // Save the filled template to a new file
        $fileName = 'Notulen_Rapat_' . $meeting->id . '.html';
        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);

        // Pastikan file berhasil disimpan sebelum dikirim sebagai response
        if (file_exists($filePath)) {
            return response()->download($filePath)->deleteFileAfterSend(false);
        } else {
            return back()->with('error', 'Failed to generate document.');
        }
    }


    // public function printMinutes($meetingId)
    // {
    //     // Mengambil data dari database (contoh)
    //     $meeting = Meeting::with('minutes')->findOrFail($meetingId);
    //     $basis = $meeting->minutes->basis;
    //     $chairperson = $meeting->minutes->chairperson;
    //     $activity = $meeting->activity;

    //     // Membuat instance TemplateProcessor dan memuat template DOCX
    //     $templateProcessor = new TemplateProcessor(storage_path('app/public/temp.docx'));

    //     // Mengganti placeholder dengan data dari database
    //     $templateProcessor->setValue('basis', 'data');
    //     $templateProcessor->setValue('chairperson', $chairperson);
    //     $templateProcessor->setValue('activity', $activity);

    //     // Menyimpan file DOCX yang telah diganti placeholdernya
    //     $fileName = 'notulen_rapat_' . $meetingId . '.pdf';
    //     $filePath = storage_path('app/public/' . $fileName);
    //     $templateProcessor->saveAs($filePath);

    //     // Mengembalikan respons untuk mengunduh file
    //     return response()->download($filePath)->deleteFileAfterSend(true);
    // }

    public function participant($meetId)
    {
        $data = [
            'participants' => Participant::where('meeting_id', $meetId)->get(),
            'meeting' => Meeting::findOrFail($meetId),
        ];

        return view('admin_jurusan.participants', $data);
    }

}
