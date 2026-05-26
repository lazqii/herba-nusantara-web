@extends('layouts.app')

@section('title', 'Dashboard Apotek')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h4 class="mb-3">👋 Selamat Datang, Admin!</h4>
        <p class="text-muted">Berikut adalah laporan harian apotek Anda tanggal {{ date('d F Y') }}</p>
    </div>
</div>

<div class="row">
<div class="row">
    <div class="col-md-4 mb-4">
        <a href="{{ route('tanaman.index') }}" class="text-decoration-none">
            <div class="card shadow-sm border-0 bg-primary text-white h-100 card-hover">
                <div class="card-body d-flex align-items-center">
                    <div class="me-4">
                        <i class="bi bi-flower1" style="font-size: 3rem; opacity: 0.8;"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 text-white-50 text-uppercase fw-bold" style="letter-spacing: 1px; font-size: 0.8rem;">Total Tanaman</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalTanaman }} <span class="fs-6 fw-normal text-white-50">spesies</span></h2>
                    </div>
                </div>
            </div>
        </a>
    </div>
    
    <div class="col-md-4 mb-4">
        <a href="{{ route('contributions.pending') }}" class="text-decoration-none">
            <div class="card shadow-sm border-0 bg-warning text-dark h-100 card-hover">
                <div class="card-body d-flex align-items-center">
                    <div class="me-4">
                        <i class="bi bi-hourglass-split" style="font-size: 3rem; opacity: 0.8;"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 text-dark-50 text-uppercase fw-bold" style="letter-spacing: 1px; font-size: 0.8rem;">Antrian Dataset</h6>
                        <h2 class="mb-0 fw-bold">{{ $pendingDataset }} <span class="fs-6 fw-normal text-dark-50">pending</span></h2>
                    </div>
                </div>
            </div>
        </a>
    </div>
    
    <div class="col-md-4 mb-4">
        <a href="{{ route('contributions.approved') }}" class="text-decoration-none">
            <div class="card shadow-sm border-0 bg-success text-white h-100 card-hover">
                <div class="card-body d-flex align-items-center">
                    <div class="me-4">
                        <i class="bi bi-images" style="font-size: 3rem; opacity: 0.8;"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 text-white-50 text-uppercase fw-bold" style="letter-spacing: 1px; font-size: 0.8rem;">Total Dataset</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalDataset }} <span class="fs-6 fw-normal text-white-50">terkumpul</span></h2>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm border-0" style="background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);">
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-laptop text-primary" style="font-size: 4rem;"></i>
                    <i class="bi bi-arrow-left-right text-muted mx-3" style="font-size: 2rem;"></i>
                    <i class="bi bi-phone text-primary" style="font-size: 4rem;"></i>
                </div>
                <h4 class="fw-bold">Sistem Manajemen Herba Nusantara</h4>
                <p class="text-muted w-75 mx-auto">Aplikasi Herba Nusantara dirancang untuk mengenali dan mendokumentasikan kekayaan tanaman herbal Indonesia. Menggunakan teknologi AI, aplikasi ini membantu masyarakat mendapatkan informasi medis botani yang akurat.</p>
            </div>
        </div>
    </div>
</div>

<style>
.card-hover {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
}
</style>
@endsection