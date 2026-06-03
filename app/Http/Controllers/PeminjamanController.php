<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class PeminjamanController extends Controller
{
    // 1. FUNGSI EKSPOR PDF (SEKARANG SUDAH DI DALAM CLASS)
    public function exportPdf()
    {
        // Mengambil semua riwayat transaksi untuk dicetak
        $peminjamans = Peminjaman::with(['barang', 'peminjam'])->latest()->get();

        // Membuka view khusus format cetakan PDF
        $pdf = Pdf::loadView('peminjaman.pdf_report', compact('peminjamans'));

        return $pdf->stream('Laporan_Sirkulasi_TEFA.pdf');
    }

    // 2. FUNGSI EKSPOR EXCEL (SEKARANG SUDAH DI DALAM CLASS)
    public function exportExcel()
    {
        // Memanggil class export bawaan Laravel Excel
        return Excel::download(new \App\Exports\PeminjamanExport, 'Laporan_Sirkulasi_TEFA.xlsx');
    }

    public function index()
    {
        // Menampilkan semua data log transaksi untuk Admin maupun User
        $peminjamans = Peminjaman::with(['barang', 'peminjam'])->latest()->get();
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $peminjams = Peminjam::all();
        $barangs = Barang::where('stok', '>', 0)->get(); // Hanya barang ready stok
        return view('peminjaman.create', compact('peminjams', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjam_id' => 'required',
            'barang_id' => 'required',
            'tanggal_pinjam' => 'required|date',
            'jumlah_pinjam' => 'required|numeric|min:1'
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($request->jumlah_pinjam > $barang->stok) {
            return back()->withErrors(['jumlah_pinjam' => 'Stok tidak mencukupi! Sisa stok aktif: ' . $barang->stok])->withInput();
        }

        Peminjaman::create($request->all());

        // POTONG STOK OTOMATIS
        $barang->decrement('stok', $request->jumlah_pinjam);

        return redirect()->route('peminjaman.index')->with('success', 'Transaksi berhasil dicatat dan stok dipotong!');
    }

    public function edit(Peminjaman $peminjaman)
    {
        return view('peminjaman.edit', compact('peminjaman'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'status_peminjaman' => 'required'
        ]);

        $barang = Barang::findOrFail($peminjaman->barang_id);
        $statusLama = $peminjaman->status_peminjaman;
        $statusBaru = $request->status_peminjaman;

        // JIKA STATUS BERUBAH MENJADI DIKEMBALIKAN -> STOK BERTAMBAH
        if ($statusLama != 'Dikembalikan' && $statusBaru == 'Dikembalikan') {
            $barang->increment('stok', $peminjaman->jumlah_pinjam);
            $peminjaman->tanggal_kembali = now()->format('Y-m-d');
        }
        // JIKA DIUBAH KEMBALI JADI DIPINJAM -> STOK BERKURANG LAGI
        elseif ($statusLama == 'Dikembalikan' && $statusBaru != 'Dikembalikan') {
            if ($peminjaman->jumlah_pinjam > $barang->stok) {
                return back()->with('error', 'Gagal mengubah status! Stok di laboratorium sudah habis.');
            }
            $barang->decrement('stok', $peminjaman->jumlah_pinjam);
            $peminjaman->tanggal_kembali = null;
        }

        $peminjaman->status_peminjaman = $statusBaru;
        $peminjaman->save();

        return redirect()->route('peminjaman.index')->with('success', 'Status transaksi dan stok berhasil diperbarui!');
    }

    // FITUR LENGKAP CRUD: HAPUS TRANSAKSI (CANCEL)
    public function destroy(Peminjaman $peminjaman)
    {
        // Jika transaksi dihapus saat statusnya masih 'Dipinjam', kembalikan stok barangnya dulu
        if ($peminjaman->status_peminjaman == 'Dipinjam') {
            $barang = Barang::findOrFail($peminjaman->barang_id);
            $barang->increment('stok', $peminjaman->jumlah_pinjam);
        }

        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Data transaksi berhasil dihapus dan stok dinormalisasi!');
    }
}
