@extends('layouts.app')

@section('content')
<div class="container">
    <div class="hero-section text-center">
        <h1 class="fw-bold mb-3">Mix & Match <span class="text-primary">Outfit</span></h1>
        <p class="text-muted mb-4">Pilih salah satu pakaian dari lemari digital Anda, dan sistem akan mencarikan kombinasi terbaik dari stok distro kami.</p>
    </div>

    @if($wardrobes->isEmpty())
        <div class="alert alert-warning text-center">
            Lemari digital Anda masih kosong. Silakan <a href="{{ route('wardrobes.create') }}">tambahkan pakaian</a> terlebih dahulu.
        </div>
    @else
        <form action="{{ route('recommendation.match') }}" method="POST">
            @csrf
            <div class="row g-4">
                @foreach($wardrobes as $w)
                <div class="col-md-3">
                    <label class="card h-100 shadow-sm border-0 cursor-pointer text-center" style="cursor: pointer;">
                        @if($w->image)
                            <img src="{{ Storage::url($w->image) }}" class="card-img-top" alt="{{ $w->name }}" style="height: 150px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center text-muted" style="height: 150px;">
                                Tanpa Foto
                            </div>
                        @endif
                        <div class="card-body">
                            <input type="radio" name="wardrobe_id" value="{{ $w->id }}" class="form-check-input mb-3" required style="width: 1.5em; height: 1.5em;">
                            <h5 class="fw-bold">{{ $w->name }}</h5>
                            <span class="badge bg-secondary mb-1">{{ $w->category->name }}</span>
                            <div class="small text-muted mt-2">
                                <div>Warna: {{ $w->color->name }}</div>
                                <div>Bahan: {{ $w->material->name }}</div>
                                <div>Tema: {{ $w->theme->name }}</div>
                            </div>
                        </div>
                    </label>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5">
                <button type="submit" class="btn btn-primary btn-lg px-5 shadow">🔍 Cari Rekomendasi</button>
            </div>
        </form>
    @endif
</div>
@endsection
