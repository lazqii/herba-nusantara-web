<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Penjualan Obat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar-container {
            width: 280px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            z-index: 1000;
        }
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
        }
        @media (max-width: 768px) {
            .sidebar-container {
                position: relative;
                width: 100%;
                height: auto;
                min-height: auto;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar-container bg-dark text-white">
        @include('partials.sidebar')
    </div>

    <div class="main-content">
        <header class="p-3 mb-3 border-bottom bg-white sticky-top">
            <div class="container-fluid">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <h4 class="mb-0">@yield('title')</h4>
                </div>
            </div>
        </header>

        <main class="p-4 flex-grow-1">
            @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- 2. Menangkap Pesan Error (Merah) - Buat jaga-jaga --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- 3. Menangkap Error Validasi Form (Misal lupa isi kolom wajib) --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ada kesalahan input:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
            @yield('content')
        </main>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tunggu sampai halaman selesai dimuat
        document.addEventListener("DOMContentLoaded", function() {
            
            // Ambil elemen alert
            var alertList = document.querySelectorAll('.alert');
            
            // Loop setiap alert yang ditemukan
            alertList.forEach(function (alertNode) {
                // Set waktu 3 detik (3000 ms)
                setTimeout(function() {
                    // Tutup alert menggunakan fungsi bawaan Bootstrap 5
                    var alert = new bootstrap.Alert(alertNode);
                    alert.close();
                }, 3000);
            });

        });
    </script>
</body>
</html>