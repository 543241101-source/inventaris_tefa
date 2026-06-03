@extends('layouts.app')

@section('content')
<div class="card border-0 shadow-sm p-4 bg-white" style="max-width: 600px;">
    <h4 class="fw-bold mb-4 text-dark">Edit Data Barang / Aset</h4>

    <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kategori Barang</label>
            <select name="kategori_barang" class="form-select" required>
                <option value="Laptop" {{ $barang->kategori_barang == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                <option value="Aksesoris" {{ $barang->kategori_barang == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Jumlah Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $barang->stok }}" required min="0">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kondisi Barang</label>
            <select name="kondisi_barang" class="form-select" required>
                <option value="Baik" {{ $barang->kondisi_barang == 'Baik' ? 'selected' : '' }}>Baik</option>
                <option value="Rusak Ringan" {{ $barang->kondisi_barang == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                <option value="Rusak Parah" {{ $barang->kondisi_barang == 'Rusak Parah' ? 'selected' : '' }}>Rusak Parah</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Foto Fisik Barang</label>
            @if($barang->foto)
                <div class="mb-2">
                    <small class="text-muted d-block">Foto saat ini:</small>
                    <img src="{{ asset('uploads/barang/' . $barang->foto) }}" class="rounded img-thumbnail" style="width: 120px;">
                </div>
            @endif
            <input type="file" name="foto" class="form-control" accept="image/*">
            <div class="form-text">Pilih file baru jika ingin mengganti foto saat ini.</div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-warning px-4 fw-bold">Update Aset</button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
