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

    <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

@endsection

@section('content')
    <div class="container-fluid">

        <div class="m-5 card shadow-lg">

            <div class="card-header bg-primary p-3">
                <h1 class="h3 mb-0 text-light">Agenda Baru, (Nama Jurusan)</h1>
            </div>

            <div class="card-body">
                <form action="{{ route('agenda.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="inputActivity" class="text-dark">Kegiatan*</label>
                        <input type="text" class="form-control" id="inputActivity" aria-describedby="activityHelp"
                            name="activity">
                        @error('activity')
                            <small id="activityHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPic" class="text-dark">PIC*</label>
                            <input type="text" class="form-control" id="inputPic" aria-describedby="picHelp"
                                name="pic">
                            @error('pic')
                                <small id="activityHelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputDate" class="text-dark">Tanggal*</label>
                            <input type="date" class="form-control" id="inputDate" name="date"
                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            @error('date')
                                <small id="activityHelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputStartTime" class="text-dark">Jam mulai*</label>
                            <input type="time" class="form-control" id="inputStartTime" name="start_time">
                            @error('start_time')
                                <small id="activityHelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEndTime" class="text-dark">Jam selesai</label>
                            <input type="time" class="form-control" id="inputEndTime" name="end_time">
                            @error('end_time')
                                <small id="activityHelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputLocation" class="text-dark">Lokasi*</label>
                        <input type="text" class="form-control" id="inputLocation" aria-describedby="locationHelp"
                            name="location">
                        @error('location')
                            <small id="activityHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('agenda.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>

                </form>
            </div>

        </div>


    </div>

@endsection
@section('js') <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>

    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <!-- Bootstrap Datepicker Language for Indonesian -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.id.min.js">
    </script>
@endsection
