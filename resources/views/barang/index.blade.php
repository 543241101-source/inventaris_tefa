@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark">Daftar Aset / Barang TEFA</h2>
    <a href="{{ route('barang.create') }}" class="btn btn-success fw-semibold">+ Tambah Barang Baru</a>
</div>

<div class="card border-0 shadow-sm p-3 mb-4 bg-white">
    <form action="{{ route('barang.index') }}" method="GET" class="row g-3">
        <div class="col-md-6">
            <input type="text" name="search" class="form-control" placeholder="Cari nama barang..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="kategori" class="form-select">
                <option value="">-- Semua Kategori --</option>
                <option value="Laptop" {{ request('kategori') == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                <option value="Aksesoris" {{ request('kategori') == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Cari</button>
        </div>
    </form>
</div>

<div class="card border-0 shadow-sm p-3 bg-white">
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Foto</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok Aktif</th>
                    <th>Kondisi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barangs as $b)
                <tr>
                    <td>
                        @if($b->foto)
                            <img src="{{ asset('uploads/barang/' . $b->foto) }}" class="rounded shadow-sm" style="width: 60px; height: 60px; object-fit: cover;">
                        @else
                            <span class="badge bg-secondary">No Photo</span>
                        @endif
                    </td>
                    <td class="fw-bold text-secondary">{{ $b->nama_barang }}</td>
                    <td>{{ $b->kategori_barang }}</td>
                    <td>
                        @if($b->stok <= 3)
                            <span class="badge bg-danger fs-6">{{ $b->stok }} pcs</span>
                        @else
                            <span class="badge bg-success fs-6">{{ $b->stok }} pcs</span>
                        @endif
                    </td>
                    <td><span class="badge bg-info text-dark">{{ $b->kondisi_barang }}</span></td>
                    <td class="text-center">
                        <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus aset ini?');" action="{{ route('barang.destroy', $b->id) }}" method="POST">
                            <a href="{{ route('barang.edit', $b->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Data barang masih kosong atau tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
