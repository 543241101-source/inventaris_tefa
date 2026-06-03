<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        // Bonus Fitur Pencarian & Filter Kategori
        $query = Barang::query();
        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('kategori')) {
            $query->where('kategori_barang', $request->kategori);
        }

        $barangs = $query->latest()->get();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori_barang' => 'required',
            'stok' => 'required|numeric|min:0',
            'kondisi_barang' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        // LOGIKA UPLOAD FOTO BARANG
        if ($request->hasFile('foto')) {
            $namaFoto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/barang'), $namaFoto);
            $data['foto'] = $namaFoto;
        }

        Barang::create($data);
        return redirect()->route('barang.index')->with('success', 'Barang berhasil disimpan!');
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori_barang' => 'required',
            'stok' => 'required|numeric|min:0',
            'kondisi_barang' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        // LOGIKA UPDATE FOTO (Hapus foto lama agar tidak menumpuk di server)
        if ($request->hasFile('foto')) {
            if ($barang->foto && File::exists(public_path('uploads/barang/' . $barang->foto))) {
                File::delete(public_path('uploads/barang/' . $barang->foto));
            }
            $namaFoto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/barang'), $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $barang->update($data);
        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy(Barang $barang)
    {
        if ($barang->foto && File::exists(public_path('uploads/barang/' . $barang->foto))) {
            File::delete(public_path('uploads/barang/' . $barang->foto));
        }
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}
