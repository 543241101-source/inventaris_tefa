<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $fillable = ['peminjam_id', 'barang_id', 'tanggal_pinjam', 'tanggal_kembali', 'jumlah_pinjam', 'status_peminjaman'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class, 'peminjam_id');
    }
}
