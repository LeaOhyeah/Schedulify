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
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        @if (session()->has('success'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>Sukses</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-primary">
                <div class="d-flex justify-content-between">
                    <h1 class="h3 mb-0 text-light">Daftar Hadir {{ $meeting->activity }}</h1>

                </div>
            </div>


            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-dark">
                            <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Tanda Tangan</th>
                            </tr>
                        </thead>
                        <tfoot class="text-dark">
                            <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Tanda Tangan</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($participants as $p)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $p->name }}
                                    </td>
                                    <td>
                                        {{ $p->position }}

                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/' . $p->signature) }}" alt=""
                                            style="width: 150px;">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>
    <!-- /.container-fluid -->
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
