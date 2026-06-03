<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Peminjaman::with(['barang', 'peminjam'])->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Kelas',
            'Alat Praktik',
            'Jumlah Pinjam',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
        ];
    }

    public function map($peminjaman): array
    {
        return [
            $peminjaman->peminjam->nama_peminjam ?? '-',
            $peminjaman->peminjam->kelas ?? '-',
            $peminjaman->barang->nama_barang ?? '-',
            $peminjaman->jumlah_pinjam . ' Unit',
            $peminjaman->tanggal_pinjam,
            $peminjaman->tanggal_kembali ?? '-',
            $peminjaman->status_peminjaman,
        ];
    }
}
