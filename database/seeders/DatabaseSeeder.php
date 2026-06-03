<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Barang;
use App\Models\Peminjam;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Login untuk Uji Coba Multi-Role
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@tefa.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User Operator',
            'email' => 'user@tefa.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // 2. Data Awal Barang (Sesuai Soal)
        Barang::create(['nama_barang' => 'Laptop Asus', 'kategori_barang' => 'Laptop', 'stok' => 10, 'kondisi_barang' => 'Baik']);
        Barang::create(['nama_barang' => 'Mouse Logitech', 'kategori_barang' => 'Aksesoris', 'stok' => 15, 'kondisi_barang' => 'Baik']);
        Barang::create(['nama_barang' => 'Keyboard Mechanical', 'kategori_barang' => 'Aksesoris', 'stok' => 8, 'kondisi_barang' => 'Baik']);

        // 3. Data Awal Peminjam (Sesuai Soal)
        Peminjam::create(['nama_peminjam' => 'Ahmad Fauzan', 'kelas' => 'XI PPLG 1', 'jurusan' => 'PPLG', 'no_hp' => '081234567890']);
        Peminjam::create(['nama_peminjam' => 'Rizky Pratama', 'kelas' => 'XI PPLG 2', 'jurusan' => 'PPLG', 'no_hp' => '081234567891']);
        Peminjam::create(['nama_peminjam' => 'Dinda Putri', 'kelas' => 'XI PPLG 1', 'jurusan' => 'PPLG', 'no_hp' => '081234567892']);
    }
}
