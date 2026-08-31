@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-4">Dashboard Admin</h2>
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body text-center p-4">
                    <h1 class="display-4 fw-bold">{{ $productsCount }}</h1>
                    <p class="mb-0">Total Stok Pakaian (Distro)</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white h-100">
                <div class="card-body text-center p-4">
                    <h1 class="display-4 fw-bold">{{ $wardrobesCount }}</h1>
                    <p class="mb-0">Pakaian User di Lemari Digital</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
