<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi Kehadiran</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .signature-pad {
            border: 1px solid #000;
            border-radius: 5px;
            width: 100%;
            height: auto;
            max-width: 100%;
        }

        .signature-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .signature-pad {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    @php
        use Carbon\Carbon;

        Carbon::setLocale('id');
    @endphp
    <div class="container mt-5">
        <div class="card shadow-lg border-dark">
            <div class="card-header bg-primary text-light">
                <h2>Presensi Kehadiran {{ $meeting->activity }}</h2>
                <h6>{{ Carbon::parse($meeting->date)->translatedFormat('l, d F Y') }},
                    {{ Carbon::parse($meeting->start_time)->format('H:i') }} -
                    {{ Carbon::parse($meeting->end_time)->format('H:i') ?? 'Selesai' }}
                </h6>
            </div>

            <div class="card-body">

                @if (session()->has('success'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>Sukses</strong> {{ session('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error</strong> {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('presensi.store', ['hashid' => bin2hex(Crypt::encryptString($meeting->id))]) }}"
                    method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="inputName">Nama</label>
                        <input type="text" class="form-control" id="inputName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="inputPosition">Jabatan</label>
                        <input type="text" class="form-control" id="inputPosition" name="position" required>
                    </div>
                    <div class="form-group">
                        <label for="signature">Tanda Tangan</label>
                        <div class="signature-container">
                            <canvas id="signature-pad" class="signature-pad"></canvas>
                        </div>
                        <input type="hidden" name="signature" id="signature">
                    </div>
                    <button type="button" class="btn btn-secondary" id="clear-signature">Clear</button>
                    <button type="submit" class="btn btn-primary">Simpan Presensi</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // JavaScript untuk signature pad
        document.addEventListener("DOMContentLoaded", function () {
            var canvas = document.getElementById('signature-pad');
            var signaturePad = new SignaturePad(canvas);

            function resizeCanvas() {
                // Tetapkan ukuran canvas standar
                var standardWidth = 400;
                var standardHeight = 200;

                // Hitung rasio untuk mempertahankan ukuran standar
                var ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = standardWidth * ratio;
                canvas.height = standardHeight * ratio;
                canvas.getContext("2d").scale(ratio, ratio);

                // Atur ukuran canvas untuk tampilan agar tidak terlalu lebar di mobile
                if (window.innerWidth < 768) {
                    canvas.style.width = "100%";
                    canvas.style.height = "auto";
                } else {
                    canvas.style.width = standardWidth + "px";
                    canvas.style.height = standardHeight + "px";
                }

                signaturePad.clear(); // Menghapus canvas karena ukuran berubah
            }

            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();

            document.getElementById('clear-signature').addEventListener('click', function () {
                signaturePad.clear();
            });

            var form = document.querySelector('form');
            form.addEventListener('submit', function (e) {
                if (signaturePad.isEmpty()) {
                    e.preventDefault();
                    alert('Harap tanda tangani dulu.');
                } else {
                    var dataUrl = signaturePad.toDataURL();
                    document.getElementById('signature').value = dataUrl;
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
</body>

</html>