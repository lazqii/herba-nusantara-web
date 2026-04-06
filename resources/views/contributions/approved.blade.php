@extends('layouts.app')
@section('title', 'Dataset Approved')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-check2-all me-2"></i> Dataset Telah Divalidasi</h5>
            @if($groupedContributions->count() > 0)
                <a href="{{ route('contributions.download') }}" class="btn btn-light btn-sm fw-bold">
                    <i class="bi bi-file-earmark-zip me-1"></i> Download Dataset (ZIP)
                </a>
            @endif
        </div>
        <div class="card-body">
            @forelse($groupedContributions as $label => $group)
                <div class="mb-5 border rounded p-3 bg-light">
                    <h5 class="text-primary mb-3 border-bottom pb-2">
                        <i class="bi bi-tags-fill me-2"></i> {{ $label }}
                        <span class="badge bg-secondary ms-2">{{ $group->count() }} approved</span>
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover bg-white align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Gambar</th>
                                    <th>Confidence Score</th>
                                    <th>Status</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($group as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="Img"
                                                style="object-fit:cover; width: 80px; height: 80px; border-radius: 8px; border:1px solid #ddd;">
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="progress flex-grow-1 me-2" style="height: 10px;">
                                                    <div class="progress-bar {{ $item->confidence_score > 0.9 ? 'bg-success' : 'bg-warning' }}"
                                                        style="width: {{ $item->confidence_score * 100 }}%"></div>
                                                </div>
                                                <span class="fw-bold">{{ number_format($item->confidence_score * 100, 2) }}%</span>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success text-white">{{ ucfirst($item->status) }}</span></td>
                                        <td>
                                            <form action="{{ route('contributions.revert', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Kembalikan data ini ke antrean Pending?');">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-warning btn-sm">
                                                    <i class="bi bi-arrow-counterclockwise"></i> Kembalikan ke Pending
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="bi bi-folder2-open text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-3">Belum ada dataset yang divalidasi. Masuk ke tab Pending untuk memulai kurasi.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection