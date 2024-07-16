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

    <!-- CKEditor Styles -->
    <style>
        .ck-editor__editable {
            min-height: 200px;
        }
    </style>
@endsection

@section('content')
    @php
        use Carbon\Carbon;

        Carbon::setLocale('id');
    @endphp

    <div class="container-fluid">
        @if (session()->has('success'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>Sukses</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Sukses</strong> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- DataTales Example schedule -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary py-3">
                <div class="d-flex justify-content-between">
                    <h1 class="h3 mb-0 text-light">Perbarui Notulensi {{ $meeting->activity }}</h1>
                    <a href="{{ route('minutes.print', $minutes->id) }}" class="text-light">Cetak</a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('admin_jurusan.minutes.update', $minutes->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="inputBasis" class="text-dark">Dasar*</label>
                        <textarea class="form-control" id="inputBasis" name="basis">{{ old('basis', $minutes->basis) }}</textarea>
                        @error('basis')
                            <small id="basisHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputChairperson" class="text-dark">Pimpinan Rapat*</label>
                        <input type="text" class="form-control" id="inputChairperson" name="chairperson"
                            value="{{ old('chairperson', $minutes->chairperson) }}">
                        @error('chairperson')
                            <small id="chairpersonHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputActivity" class="text-dark">Agenda*</label>
                        <input type="text" class="form-control" id="inputActivity" readonly
                            value="{{ $meeting->activity }}">
                    </div>

                    <div class="form-group">
                        <label for="inputMinuteTaker" class="text-dark">Notulis*</label>
                        <input type="text" class="form-control" id="inputMinuteTaker" name="minute_taker"
                            value="{{ old('minute_taker', $minutes->minute_taker) }}">
                        @error('minute_taker')
                            <small id="minuteTakerHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputDate" class="text-dark">Hari/Tanggal*</label>
                            <input type="text" class="form-control" id="inputDate" readonly
                                value="{{ Carbon::parse($meeting->date)->translatedFormat('l, d F Y') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputTime" class="text-dark">Pukul*</label>
                            <input type="text" class="form-control" id="inputTime" readonly
                                value=" {{ Carbon::parse($meeting->start_time)->format('H:i') }} - {{ Carbon::parse($meeting->end_time)->format('H:i') ?? 'Selesai' }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputLocation" class="text-dark">Tempat*</label>
                        <input type="text" class="form-control" id="inputLocation" readonly
                            value=" {{ $meeting->location }}">
                    </div>

                    <div class="form-group">
                        <label for="inputMethod" class="text-dark">Metode*</label>
                        <input type="text" class="form-control" id="inputMethod" name="method"
                            value="{{ old('method', $minutes->method) }}">
                        @error('method')
                            <small id="methodHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputOutcome" class="text-dark">Hasil*</label>
                        <textarea class="form-control" id="inputOutcome" name="outcome">{{ old('outcome', $minutes->outcome) }}</textarea>
                        @error('outcome')
                            <small id="outcomeHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin_jurusan.meetings.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
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

    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>



    <script>
        ClassicEditor
            .create(document.querySelector('#inputBasis'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#inputOutcome'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
