@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Update Model AI (Over-The-Air)</h2>
            <p class="text-muted">Aplikasi Mobile akan secara otomatis mengunduh Model AI versi terbaru begitu Anda merilisnya di halaman ini.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Status Versi Saat Ini</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Version</strong>
                            <span class="badge bg-success rounded-pill px-3 py-2">v{{ $version }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Model File URL (.tflite):</strong><br/>
                            @if($url)
                                <a href="{{ $url }}" target="_blank" class="text-break fs-6" style="word-break: break-all;">{{ $url }}</a>
                            @else
                                <span class="text-muted text-break">Belum ada file terupload</span>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <strong>Labels File URL (.txt):</strong><br/>
                            @if($labels_url)
                                <a href="{{ $labels_url }}" target="_blank" class="text-break fs-6" style="word-break: break-all;">{{ $labels_url }}</a>
                            @else
                                <span class="text-muted text-break">Belum ada file terupload</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Upload Pembaruan File TFLite</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('configs.model.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="alert alert-info py-2">
                            <i class="bi bi-info-circle me-2"></i> Input resolusi tetap harus dikonfigurasi ke <b>224x224</b> pixels sesuai default MobileNetV2.
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">1. File Model (.tflite)</label>
                            <input type="file" class="form-control" name="model_file" accept=".tflite" required>
                            <div class="form-text">Maksimal ukuran file disesuaikan batas server. Disarankan model ukuran < 15MB.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">2. File Class Labels (.txt)</label>
                            <input type="file" class="form-control" name="labels_file" accept=".txt" required>
                            <div class="form-text">Satu baris untuk setiap nama tanaman (pastikan urutan baris ke Bawah sama persis dengan urutan array output layer AI Anda dari Jupyter/Colab).</div>
                        </div>
                        
                        <hr/>
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                            <i class="bi bi-upload me-2"></i> Publish OTA Update Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
