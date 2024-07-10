@extends('admin_jurusan.layouts.main')
@section('title', 'Agenda (Nama Jurusan)')

@section('css')
    <!-- Custom fonts for this template-->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <!-- DataTales Example today -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <h1 class="h3 mb-0 text-gray-800">Daftar Agenda Hari Ini (Nama Jurusan)</h1>
                    <a href="{{ route('agenda.create') }}" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Baru</span>
                    </a>
                </div>
            </div>
        
        
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kegiatan</th>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>PIC</th>
                                <th></th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Kegiatan</th>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>PIC</th>
                                <th></th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($meetings_today as $mt)
                                <tr>
                                    <td><a class="text-decoration-none text-dark" href="{{ route('agenda.edit', $mt->id) }}">
                                            {{ $mt->activity }}
                                        </a>
                                    </td>
                                    <td><a class="text-decoration-none text-dark" href="{{ route('agenda.edit', $mt->id) }}">
                                            {{ $mt->date }}
                                        </a>
                                    </td>
                                    <td><a class="text-decoration-none text-dark" href="{{ route('agenda.edit', $mt->id) }}">
                                            {{ $mt->location }}
                                        </a>
                                    </td>
                                    <td><a class="text-decoration-none text-dark" href="{{ route('agenda.edit', $mt->id) }}">
                                            {{ $mt->start_time }}
                                        </a>
                                    </td>
                                    <td><a class="text-decoration-none text-dark" href="{{ route('agenda.edit', $mt->id) }}">
                                            {{ $mt->end_time ?? 'Sampai Selesai' }}
                                        </a>
                                    </td>
                                    <td><a class="text-decoration-none text-dark" href="{{ route('agenda.edit', $mt->id) }}">
                                            {{ $mt->pic }}
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('agenda.destroy', $mt->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah anda yakin ingin menghapus {{ $mt->activity }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-circle">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="d-flex justify-content-between">
                                        <a href="#"
                                            class="btn btn-sm btn-primary" onclick="copyToClipboard('{{ route('presensi.peserta', bin2hex(Crypt::encryptString($mt->id))) }}')">Link Presensi</a>
                                            <a class="btn btn-sm btn-outline-primary" href="{{ route('minutes.create', $mt->id) }}">Buat Notulensi</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
@endsection

@section('js')
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>

    <script>
        function copyToClipboard(link) {
            // Membuat elemen textarea secara dinamis untuk menyalin teks
            var tempInput = document.createElement("textarea");
            tempInput.value = link;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);

            // Menampilkan pesan notifikasi (opsional)
            alert("Link telah disalin ke clipboard!");
        }
    </script>
@endsection
