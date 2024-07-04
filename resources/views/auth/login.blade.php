@extends('auth.layouts.main')

@section('title', 'Login')


@section('content')
    <body class="bg-gradient-primary">

        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">

                            <div class="row"> <!-- Nested Row within Card Body -->
                                <div class="col-lg-6 d-none d-lg-block bg-login-image">

                                </div>

                                <div class="col-lg-6">
                                    <div class="p-5">

                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                        </div>

                                        {{-- <form class="user"> --}}
                                        <form method="POST" action="{{ route('login') }}" class="user">
                                            @csrf
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                                    placeholder="Masukkan Alamat Email..." value="{{ old('email') }}"
                                                    name="email" autofocus>
                                                @error('email')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <input type="password"
                                                    class="form-control form-control-user @error('password') is-invalid @enderror"
                                                    id="exampleInputPassword" placeholder="Masukkan Kata Sandi..."
                                                    name="password">
                                                @error('password')
                                                    <small class="invalid-feedback d-block">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            @error('error')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                <br>
                                            @enderror

                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Login
                                            </button>
                                            <hr>
                                        </form>

                                        <div class="text-center">
                                            <a class="small" href="forgot-password.html">Lupa Kata Sandi?</a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </body>
@endsection
