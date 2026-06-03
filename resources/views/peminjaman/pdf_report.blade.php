<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Sirkulasi TEFA</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #000; }
        th { background-color: #f2f2f2; padding: 8px; text-align: left; }
        td { padding: 8px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Sirkulasi Barang & Peminjaman</h2>
        <h3>Laboratorium TEFA (Technopark)</h3>
        <p>Tanggal Cetak: {{ date('d-m-Y H:i:s') }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Alat / Barang</th>
                <th>Jumlah</th>
                <th>Tgl Pinjam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamans as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->peminjam->nama_peminjam ?? '-' }} ({{ $p->peminjam->kelas ?? '-' }})</td>
                <td>{{ $p->barang->nama_barang ?? '-' }}</td>
                <td>{{ $p->jumlah_pinjam }} Unit</td>
                <td>{{ $p->tanggal_pinjam }}</td>
                <td>{{ $p->status_peminjaman }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
