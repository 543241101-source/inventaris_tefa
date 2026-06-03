@extends('layouts.app')

@section('content')
<div class="card border-0 shadow-sm p-4 bg-white" style="max-width: 600px;">
    <h4 class="fw-bold mb-4 text-dark">Tambah Barang Baru</h4>

    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required placeholder="Contoh: Laptop Asus Rogue">
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Kategori Barang</label>
            <select name="kategori_barang" class="form-select" required>
                <option value="Laptop">Laptop</option>
                <option value="Aksesoris">Aksesoris</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Jumlah Stok</label>
            <input type="number" name="stok" class="form-control" required min="1" placeholder="0">
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Kondisi Barang</label>
            <select name="kondisi_barang" class="form-select" required>
                <option value="Baik">Baik</option>
                <option value="Rusak Ringan">Rusak Ringan</option>
                <option value="Rusak Parah">Rusak Parah</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold">Foto Fisik Barang (Poin Gambar)</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
            <div class="form-text">Format: JPG, JPEG, PNG. Maksimal 2MB.</div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success px-4">Simpan Aset</button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
