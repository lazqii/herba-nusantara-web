@extends('layouts.app')

@section('title', 'Dashboard Apotek')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h4 class="mb-3">👋 Selamat Datang, Admin!</h4>
        <p class="text-muted">Berikut adalah laporan harian apotek Anda tanggal {{ date('d F Y') }}</p>
    </div>
</div>

{{-- Nanti bisa ditambahkan Statistik Tanaman di sini --}}
@endsection