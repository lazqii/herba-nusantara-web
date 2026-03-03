@forelse($tanamans as $index => $tanaman)
<tr>
    <td>{{ $index + 1 }}</td>
    <td>
        @if($tanaman->gambar)
            <img src="{{ Storage::url($tanaman->gambar) }}" alt="{{ $tanaman->nama_tanaman }}" class="img-thumbnail" style="max-width: 80px;">
        @else
            <span class="text-muted">Tidak ada gambar</span>
        @endif
    </td>
    <td class="fw-bold">{{ $tanaman->nama_tanaman }}</td>
    <td>{{ Str::limit($tanaman->deskripsi, 100) }}</td>
    <td>
        <a href="{{ route('tanaman.edit', $tanaman->id) }}" class="btn btn-sm btn-warning">
            <i class="bi bi-pencil"></i> Edit
        </a>

        <form action="{{ route('tanaman.destroy', $tanaman->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus tanaman ini?')"> 
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">
                <i class="bi bi-trash"></i> Hapus
            </button>
        </form>
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="text-center text-muted py-3">Data tanaman belum tersedia</td>
</tr>
@endforelse
