@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Lemari Digital Saya</h2>
        <a href="{{ route('wardrobes.create') }}" class="btn btn-primary">+ Tambah Pakaian</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        @forelse($wardrobes as $w)
        <div class="col-md-3">
            <div class="card h-100 shadow-sm border-0">
                @if($w->image)
                    <img src="{{ Storage::url($w->image) }}" class="card-img-top" alt="{{ $w->name }}" style="height: 200px; object-fit: cover;">
                @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center text-muted" style="height: 200px;">
                        Tanpa Foto
                    </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="fw-bold">{{ $w->name }}</h5>
                    <span class="badge bg-secondary mb-2">{{ $w->category->name }}</span>
                    <ul class="list-unstyled small text-muted mb-3 flex-grow-1">
                        <li><strong>Warna:</strong> {{ $w->color->name }}</li>
                        <li><strong>Bahan:</strong> {{ $w->material->name }}</li>
                        <li><strong>Tema:</strong> {{ $w->theme->name }}</li>
                    </ul>
                    <form action="{{ route('wardrobes.destroy', $w->id) }}" method="POST" onsubmit="return confirm('Hapus pakaian ini?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 text-muted">
            Belum ada pakaian di lemari Anda. Mulai tambahkan sekarang!
        </div>
        @endforelse
    </div>
</div>
@endsection
