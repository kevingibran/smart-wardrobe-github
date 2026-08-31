@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Katalog Produk</h2>
        <form action="{{ route('catalog.index') }}" method="GET" class="d-flex">
            <select name="category_id" class="form-select me-2" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" {{ request('category_id') == $c->id ? 'selected' : '' }}>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        @forelse($products as $product)
        <div class="col-md-3">
            <div class="card h-100 shadow-sm border-0">
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center text-muted" style="height: 200px;">
                        Tanpa Foto
                    </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="fw-bold mb-1">{{ $product->name }}</h5>
                    <div class="mb-2">
                        <span class="badge bg-secondary">{{ $product->category->name }}</span>
                    </div>
                    <ul class="list-unstyled small text-muted mb-3 flex-grow-1">
                        <li><strong>Warna:</strong> {{ $product->color->name }}</li>
                        <li><strong>Bahan:</strong> {{ $product->material->name }}</li>
                        <li><strong>Tema:</strong> {{ $product->theme->name }}</li>
                    </ul>
                    <form action="{{ route('wardrobes.storeFromProduct') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-outline-primary w-100">+ Tambah ke Wardrobe</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 text-muted">
            Belum ada produk yang tersedia.
        </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection
