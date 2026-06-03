@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark">Data Anggota Peminjam (Siswa)</h2>
        <p class="text-muted mb-0">Kelola daftar hak akses siswa yang diizinkan meminjam aset alat laboratorium.</p>
    </div>
    <a href="{{ route('peminjam.create') }}" class="btn btn-success fw-semibold">+ Tambah Siswa Baru</a>
</div>

<div class="card border-0 shadow-sm p-3 bg-white">
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Nama Lengkap Siswa</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>No. HP</th>
                    <th class="text-center" style="width: 180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjams as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="fw-bold text-secondary">{{ $p->nama_peminjam }}</td>
                    <td><span class="badge bg-primary">{{ $p->kelas }}</span></td>
                    <td>{{ $p->jurusan }}</td>
                    <td><span class="text-success fw-semibold">📞 {{ $p->no_hp }}</span></td>
                    <td class="text-center">
                        <form onsubmit="return confirm('Hapus data siswa ini? Semua riwayat pinjamannya juga akan ikut terhapus!');" action="{{ route('peminjam.destroy', $p->id) }}" method="POST">
                            <a href="{{ route('peminjam.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Belum ada data siswa terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
