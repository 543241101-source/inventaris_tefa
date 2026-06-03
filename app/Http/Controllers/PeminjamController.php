<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use App\Models\Peminjaman; // 👈 UTAMA: Ini biar class Peminjaman kagak error 'not imported' lagi!
use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    public function index()
    {
        $peminjams = Peminjam::latest()->get();
        return view('peminjam.index', compact('peminjams'));
    }

    public function create()
    {
        return view('peminjam.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_hp' => 'required'
        ]);

        Peminjam::create($request->all());
        return redirect()->route('peminjam.index')->with('success', 'Data peminjam berhasil ditambahkan!');
    }

    public function edit(Peminjam $peminjam)
    {
        return view('peminjam.edit', compact('peminjam'));
    }

    public function update(Request $request, Peminjam $peminjam)
    {
        $request->validate([
            'nama_peminjam' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_hp' => 'required'
        ]);

        $peminjam->update($request->all());
        return redirect()->route('peminjam.index')->with('success', 'Data peminjam berhasil diubah!');
    }

    public function destroy(Peminjam $peminjam)
    {
        $peminjam->delete();
        return redirect()->route('peminjam.index')->with('success', 'Data peminjam berhasil dihapus!');
    }

    // 1. FITUR EXCEL NATIVE CSV (BEBAS COMPOSER BENTROK)
    public function exportExcel()
    {
        $peminjamans = Peminjaman::with(['barang', 'peminjam'])->latest()->get();
        $fileName = 'Laporan_Sirkulasi_TEFA_' . date('Ymd_His') . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($peminjamans) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF)); // BOM biar rapi di Excel Windows

            fputcsv($file, ['Nama Siswa', 'Kelas', 'Alat Praktik', 'Jumlah Pinjam', 'Tanggal Pinjam', 'Tanggal Kembali', 'Status'], ';');

            foreach ($peminjamans as $p) {
                fputcsv($file, [
                    $p->peminjam->nama_peminjam ?? '-',
                    $p->peminjam->kelas ?? '-',
                    $p->barang->nama_barang ?? '-',
                    $p->jumlah_pinjam . ' Unit',
                    $p->tanggal_pinjam,
                    $p->tanggal_kembali ?? '-',
                    $p->status_peminjaman
                ], ';');
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // 2. FITUR PDF STREAM BROWSER
 public function exportPdf()
{
    // Ambil data dari database seperti biasa
    $peminjamans = Peminjaman::with(['barang', 'peminjam'])->latest()->get();

    // Tampilkan view laporan
    return view('peminjaman.pdf_report', compact('peminjamans'));
}
}
