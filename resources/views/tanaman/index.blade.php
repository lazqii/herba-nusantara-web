@extends('layouts.app') 
@section('title', 'Data Tanaman') 
@section('content') 
<div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Tanaman</h5>
            <div class="d-flex">
                {{-- Form Pencarian --}}
                <form action="{{ route('tanaman.index') }}" method="GET" class="d-flex me-2" id="search-form">
                    <input type="text" 
                        id="keyword"
                        name="search" 
                        class="form-control form-control-sm me-2" 
                        placeholder="Cari Nama Tanaman..." 
                        value="{{ request('search') }}"
                        autocomplete="off"> 
                </form>
           {{-- Tombol Tambah --}}
        <a href="{{ route('tanaman.create') }}" class="btn btn-light btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Tanaman
        </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Gambar</th>
                            <th width="20%">Nama Tanaman</th>
                            <th>Deskripsi</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-tanaman">
                        @include('tanaman.partials.table', ['tanamans' => $tanamans])
                    </tbody>
                </table>
            </div>
            
            <script>
                // Live Search Logic
                const keyword = document.getElementById('keyword');
                const tabelTanaman = document.getElementById('tabel-tanaman');

                keyword.addEventListener('keyup', function() {
                    let value = keyword.value;
                    fetch("{{ route('tanaman.index') }}?search=" + value, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        tabelTanaman.innerHTML = html;
                    })
                    .catch(error => console.error('Error:', error));
                });
            </script>
        </div>
    </div>
@endsection
