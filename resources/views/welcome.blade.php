@extends('layouts.app')

@section('content')
<div class="container text-center py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="display-4 fw-bold mb-4">👕 My <span class="text-primary">Wardrobe</span></h1>
            <p class="lead text-muted mb-5">
                Selamat datang di Aplikasi Rekomendasi Mix & Match Pakaian! <br>
                Temukan kombinasi outfit terbaik dari koleksi pribadi Anda dengan stok distro kami 
            </p>
            
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 shadow">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-5 shadow-sm">Daftar Akun Baru</a>
            </div>
            
            <div class="mt-5 pt-5 text-muted small">
                <p>&copy; {{ date('Y') }} My Wardrobe</p>
            </div>
        </div>
    </div>
</div>
@endsection
