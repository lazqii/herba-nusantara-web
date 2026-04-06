@extends('layouts.app') 
@section('title', 'Dataset Pending') 
@section('content') 
<div class="card shadow-sm">
    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-hourglass-split me-2"></i> Antrean Validasi Dataset</h5>
        @if($groupedContributions->count() > 0)
            <form action="{{ route('contributions.reject_all') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin MENOLAK SELURUH antrean pending ini secara permanen?');">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash-fill me-1"></i> Reject All
                </button>
            </form>
        @endif
    </div>
    <div class="card-body">
        @forelse($groupedContributions as $label => $group)
            <div class="mb-5 border rounded p-3 bg-light">
                <h5 class="text-primary mb-3 border-bottom pb-2">
                    <i class="bi bi-tags-fill me-2"></i> {{ $label }} 
                    <span class="badge bg-secondary ms-2">{{ $group->count() }} pending</span>
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
                                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="Img" style="object-fit:cover; width: 80px; height: 80px; border-radius: 8px; border:1px solid #ddd;">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 me-2" style="height: 10px;">
                                                <div class="progress-bar {{ $item->confidence_score > 0.9 ? 'bg-success' : 'bg-warning' }}" style="width: {{ $item->confidence_score * 100 }}%"></div>
                                            </div>
                                            <span class="fw-bold">{{ number_format($item->confidence_score * 100, 2) }}%</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-warning text-dark">{{ ucfirst($item->status) }}</span></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <form action="{{ route('contributions.approve', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-check-circle"></i> Approve</button>
                                            </form>
                                            <form action="{{ route('contributions.reject', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menolak file ini?');">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-x-circle"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-check2-circle text-success" style="font-size: 3rem;"></i>
                <p class="text-muted mt-3">Tidak ada antrean dataset saat ini. Semuanya sudah divalidasi!</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
