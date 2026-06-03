@extends('layouts.app')

@section('content')
<div class="card border-0 shadow-sm p-4 bg-white" style="max-width: 600px;">
    <h4 class="fw-bold mb-4 text-dark">Edit Data Anggota Peminjam</h4>

    <form action="{{ route('peminjam.update', $peminjam->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Lengkap Siswa</label>
            <input type="text" name="nama_peminjam" class="form-control" value="{{ $peminjam->nama_peminjam }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kelas</label>
            <input type="text" name="kelas" class="form-control" value="{{ $peminjam->kelas }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Jurusan</label>
            <input type="text" name="jurusan" class="form-control" value="{{ $peminjam->jurusan }}" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">No. HP / WhatsApp Kontak</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $peminjam->no_hp }}" required>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-warning px-4 fw-bold">Update Data</button>
            <a href="{{ route('peminjam.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
