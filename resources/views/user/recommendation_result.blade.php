@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <a href="{{ route('recommendation.index') }}" class="text-decoration-none text-muted">← Kembali ke Pemilihan</a>
    </div>

    <div class="row mb-5">
        <div class="col-md-8 mx-auto text-center">
            <h2 class="fw-bold mb-3">Hasil <span class="text-primary">Rekomendasi</span></h2>
            <p class="text-muted">Rekomendasi pakaian distro yang cocok untuk <strong>{{ $wardrobe->name }}</strong> ({{ $wardrobe->category->name }}).</p>
        </div>
    </div>

    @if($products->isEmpty())
        <div class="alert alert-info text-center">
            Maaf, belum ada pakaian di distro yang cocok dengan atribut pakaian Anda.
        </div>
    @else
        <div class="row g-4">
            @foreach($products as $p)
            <div class="col-md-4">
                <div class="card h-100">
                    @if($p->image)
                        <img src="{{ asset('storage/' . $p->image) }}" class="card-img-top object-fit-cover" alt="{{ $p->name }}" style="height: 250px;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center text-muted" style="height: 250px;">
                            <span>Tidak ada foto</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="fw-bold mb-0">{{ $p->name }}</h5>
                            <span class="badge bg-success">Cocok {{ round(($p->similarity_score / 6) * 100) }}%</span>
                        </div>
                        <h6 class="text-primary fw-bold mb-3">Rp {{ number_format($p->price, 0, ',', '.') }}</h6>
                        
                        <div class="small text-muted mb-3">
                            <span class="badge bg-light text-dark border">{{ $p->category->name }}</span>
                            <span class="badge bg-light text-dark border">{{ $p->color->name }}</span>
                            <span class="badge bg-light text-dark border">{{ $p->material->name }}</span>
                            <span class="badge bg-light text-dark border">{{ $p->theme->name }}</span>
                        </div>
                        
                        <p class="small text-muted mb-2">{{ Str::limit($p->description, 60) }}</p>
                        
                        @if($p->recommendation_reason)
                        <div class="alert alert-success py-2 px-3 small mb-3" style="font-size: 0.8rem; line-height: 1.4;">
                            {{ $p->recommendation_reason }}
                        </div>
                        @endif
                        
                        <div class="mt-auto pt-3 border-top">
                            <button class="btn btn-outline-primary btn-sm w-100">❤️ Favoritkan & Pesan</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
