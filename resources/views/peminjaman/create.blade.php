@extends('layouts.app')

@section('content')
<div class="card border-0 shadow-sm p-4 bg-white" style="max-width: 600px;">
    <h4 class="fw-bold mb-4 text-dark">Input Transaksi Peminjaman</h4>

    @if($errors->has('jumlah_pinjam'))
        <div class="alert alert-danger py-2 mb-3 small">{{ $errors->first('jumlah_pinjam') }}</div>
    @endif

    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Pilih Siswa Peminjam</label>
            <select name="peminjam_id" class="form-select" required>
                @foreach($peminjams as $s)
                    <option value="{{ $s->id }}">{{ $s->nama_peminjam }} ({{ $s->kelas }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Pilih Barang Praktik</label>
            <select name="barang_id" class="form-select" required>
                @foreach($barangs as $b)
                    <option value="{{ $b->id }}">{{ $b->nama_barang }} - [Stok: {{ $b->stok }}]</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Tanggal Peminjaman</label>
            <input type="date" name="tanggal_pinjam" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold">Jumlah yang Dipinjam</label>
            <input type="number" name="jumlah_pinjam" class="form-control" min="1" required placeholder="0">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4">Eksekusi Pinjam</button>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
