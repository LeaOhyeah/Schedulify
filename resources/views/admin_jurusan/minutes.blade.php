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
        <!-- DataTales Example schedule -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary py-3">
                <div class="d-flex justify-content-between">
                    <h1 class="h3 mb-0 text-light">Notulensi {{ $meeting->activity }}</h1>
                </div>
            </div>


            <div class="card-body">
                <form action="">

                    <div class="form-group">
                        <label for="inputBasis" class="text-dark">Dasar*</label>
                        <input type="text" class="form-control" id="inputBasis" aria-describedby="basisHelp"
                            name="basis">
                        @error('basis')
                            <small id="basisHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="inputChairperson" class="text-dark">Pimpinan Rapat*</label>
                        <input type="text" class="form-control" id="inputChairperson" aria-describedby="chairpersonHelp"
                            name="basis">
                        @error('basis')
                            <small id="chairpersonHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputActivity" class="text-dark">Agenda*</label>
                        <input type="text" class="form-control" id="inputActivity" aria-describedby="activityHelp"
                            name="basis">
                        @error('basis')
                            <small id="activityHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </form>
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
