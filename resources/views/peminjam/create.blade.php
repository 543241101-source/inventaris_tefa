@extends('layouts.app')

@section('content')
<div class="card border-0 shadow-sm p-4 bg-white" style="max-width: 600px;">
    <h4 class="fw-bold mb-4 text-dark">Tambah Anggota Peminjam Baru</h4>

    <form action="{{ route('peminjam.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Lengkap Siswa</label>
            <input type="text" name="nama_peminjam" class="form-control" required placeholder="Contoh: Muhammad Rafli">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kelas</label>
            <input type="text" name="kelas" class="form-control" required placeholder="Contoh: XII PPLG 1">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Jurusan</label>
            <input type="text" name="jurusan" class="form-control" required placeholder="Contoh: PPLG / TJKT">
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">No. HP / WhatsApp Kontak</label>
            <input type="text" name="no_hp" class="form-control" required placeholder="Contoh: 08xx">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success px-4 fw-semibold">Simpan Data</button>
            <a href="{{ route('peminjam.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
