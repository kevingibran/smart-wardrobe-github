@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Manajemen Stok Distro</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Tambah Produk</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        @forelse($products as $p)
        <div class="col-md-3">
            <div class="card h-100">
                @if($p->image)
                    <img src="{{ asset('storage/' . $p->image) }}" class="card-img-top object-fit-cover" alt="{{ $p->name }}" style="height: 200px;">
                @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center text-muted" style="height: 200px;">
                        <span>Tidak ada foto</span>
                    </div>
                @endif
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="fw-bold mb-0">{{ $p->name }}</h5>
                    </div>
                    <h6 class="text-primary fw-bold mb-3">Rp {{ number_format($p->price, 0, ',', '.') }}</h6>
                    
                    <ul class="list-unstyled small text-muted mb-3">
                        <li><strong>Kategori:</strong> {{ $p->category->name }}</li>
                        <li><strong>Warna:</strong> {{ $p->color->name }}</li>
                        <li><strong>Bahan:</strong> {{ $p->material->name }}</li>
                        <li><strong>Tema:</strong> {{ $p->theme->name }}</li>
                    </ul>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.products.edit', $p->id) }}" class="btn btn-sm btn-outline-primary w-50">Edit</a>
                        <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?');" class="w-50">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger w-100">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 text-muted">
            Belum ada produk. Tambahkan stok distro untuk mulai direkomendasikan!
        </div>
        @endforelse
    </div>
</div>
@endsection
