@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Tambah Pakaian ke Lemari</h4>
                    
                    <form action="{{ route('wardrobes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Pakaian (Misal: Kemeja Flannel)</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Kategori</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">Pilih...</option>
                                    @foreach($categories as $c) <option value="{{ $c->id }}">{{ $c->name }}</option> @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Warna Dominan</label>
                                <select name="color_id" class="form-select" required>
                                    <option value="">Pilih...</option>
                                    @foreach($colors as $c) <option value="{{ $c->id }}">{{ $c->name }}</option> @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Jenis Bahan</label>
                                <select name="material_id" class="form-select" required>
                                    <option value="">Pilih...</option>
                                    @foreach($materials as $c) <option value="{{ $c->id }}">{{ $c->name }}</option> @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tema Pakaian</label>
                                <select name="theme_id" class="form-select" required>
                                    <option value="">Pilih...</option>
                                    @foreach($themes as $c) <option value="{{ $c->id }}">{{ $c->name }}</option> @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('wardrobes.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan ke Lemari</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
