@extends('layouts.app')

@section('content')

{{-- Header --}}
<div class="row mb-4">
    <div class="col">
        <h2 class="fw-bold" style="color: #1a1a2e;">Selamat Datang di Sistem TEFA</h2>
        <p class="text-muted mb-0">
            Halo <strong>{{ auth()->user()->name }}</strong>, Anda masuk sebagai
            <span class="badge fw-semibold" style="background-color: #b51a21; color: #fff; font-size: 11px; letter-spacing: 0.5px;">
                {{ strtoupper(auth()->user()->role) }}
            </span>
        </p>
    </div>
</div>

{{-- ================= ADMIN ================= --}}
@if(auth()->user()->role == 'admin')

    {{-- Alert Stok Menipis --}}
    @if($stokMenipis->count() > 0)
    <div class="alert mb-4 p-3" role="alert" style="background-color: #fff5f5; border: 1px solid #f5c2c2; border-left: 4px solid #b51a21; border-radius: 10px;">
        <h6 class="fw-bold mb-1" style="color: #b51a21;">⚠️ Stok Alat Lab Hampir Habis!</h6>
        <p class="small text-muted mb-2">Segera lakukan pengadaan pada barang berikut:</p>
        <ul class="mb-0 small ps-3">
            @foreach($stokMenipis as $b)
                <li style="color: #b51a21;" class="fw-semibold">
                    {{ $b->nama_barang }}
                    <span class="text-muted fw-normal">(Sisa: {{ $b->stok }} unit)</span>
                </li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Statistik Cards --}}
    <div class="row g-4 mb-4">

        {{-- Card 1: Total Peminjam --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 p-4" style="border-radius: 12px; border-left: 4px solid #6c757d !important; background: #fff;">
                <p class="text-muted small fw-semibold text-uppercase mb-1" style="letter-spacing: 0.5px; font-size: 11px;">Total Peminjam</p>
                <h2 class="fw-bold mb-1" style="color: #1a1a2e;">{{ $totalPengguna }}</h2>
                <span class="text-muted small">Pengguna Terdaftar</span>
            </div>
        </div>

        {{-- Card 2: Total Stok --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 p-4" style="border-radius: 12px; border-left: 4px solid #b51a21 !important; background: #fff;">
                <p class="text-muted small fw-semibold text-uppercase mb-1" style="letter-spacing: 0.5px; font-size: 11px;">Total Stok Alat Lab</p>
                <h2 class="fw-bold mb-1" style="color: #b51a21;">{{ $totalPeralatan }}</h2>
                <span class="text-muted small">Unit Tersedia</span>
            </div>
        </div>

        {{-- Card 3: Peminjaman Aktif --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 p-4" style="border-radius: 12px; border-left: 4px solid #e0a800 !important; background: #fff;">
                <p class="text-muted small fw-semibold text-uppercase mb-1" style="letter-spacing: 0.5px; font-size: 11px;">Peminjaman Aktif</p>
                <h2 class="fw-bold mb-1" style="color: #e0a800;">{{ $peminjamanAktif }}</h2>
                <span class="text-muted small">Transaksi Berlangsung</span>
            </div>
        </div>
    </div>

    {{-- Divider --}}
    <div class="d-flex align-items-center gap-3 my-4">
        <span class="fw-bold text-muted small text-uppercase" style="letter-spacing: 1px; font-size: 11px; white-space: nowrap;">Menu Cepat Admin</span>
        <hr class="flex-grow-1 m-0" style="border-color: #e5e7eb;">
    </div>

    {{-- Shortcut Cards Admin --}}
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100 p-4" style="border-radius: 12px; background: #fff;">
                <div class="mb-3">
                    <span style="font-size: 28px;">📦</span>
                </div>
                <h5 class="fw-bold mb-1" style="color: #1a1a2e;">Kelola Aset Barang</h5>
                <p class="small text-muted mb-4">Perbarui data stok, kondisi barang, atau cek data gambar item laboratorium.</p>
                <a href="{{ route('barang.index') }}" class="btn btn-sm fw-semibold px-4 mt-auto align-self-start" style="background-color: #1a1a2e; color: #fff; border-radius: 8px;">
                    Buka Data Barang →
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100 p-4" style="border-radius: 12px; background: #fff;">
                <div class="mb-3">
                    <span style="font-size: 28px;">💻</span>
                </div>
                <h5 class="fw-bold mb-1" style="color: #1a1a2e;">Operasional Transaksi</h5>
                <p class="small text-muted mb-4">Catat peminjaman baru atau ubah status pengembalian barang secara langsung.</p>
                <a href="{{ route('peminjaman.index') }}" class="btn btn-sm fw-semibold px-4 mt-auto align-self-start" style="background-color: #b51a21; color: #fff; border-radius: 8px;">
                    Mulai Peminjaman →
                </a>
            </div>
        </div>
    </div>

{{-- ================= USER / SISWA ================= --}}
@elseif(auth()->user()->role == 'user')

    {{-- Divider --}}
    <div class="d-flex align-items-center gap-3 my-4">
        <span class="fw-bold text-muted small text-uppercase" style="letter-spacing: 1px; font-size: 11px; white-space: nowrap;">Menu Jalan Pintas</span>
        <hr class="flex-grow-1 m-0" style="border-color: #e5e7eb;">
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100 p-4" style="border-radius: 12px; background: #fff;">
                <div class="mb-3">
                    <span style="font-size: 28px;">🔍</span>
                </div>
                <h5 class="fw-bold mb-1" style="color: #1a1a2e;">Lihat Daftar Alat Lab</h5>
                <p class="small text-muted mb-4">Cek ketersediaan barang prasarana praktik yang siap untuk dipinjam saat ini.</p>
                <a href="{{ route('barang.index') }}" class="btn btn-sm fw-semibold px-4 mt-auto align-self-start" style="background-color: #b51a21; color: #fff; border-radius: 8px;">
                    Lihat Katalog →
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100 p-4" style="border-radius: 12px; background: #fff;">
                <div class="mb-3">
                    <span style="font-size: 28px;">📝</span>
                </div>
                <h5 class="fw-bold mb-1" style="color: #1a1a2e;">Riwayat Peminjaman</h5>
                <p class="small text-muted mb-4">Pantau status pengembalian atau pengajuan peminjaman aktif milikmu.</p>
                <a href="{{ route('peminjaman.index') }}" class="btn btn-sm fw-semibold px-4 mt-auto align-self-start" style="background-color: #1a1a2e; color: #fff; border-radius: 8px;">
                    Cek Riwayat →
                </a>
            </div>
        </div>
    </div>

@endif

@endsection
