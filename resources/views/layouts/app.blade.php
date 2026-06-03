    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inventaris TEFA</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body { background-color: #f8f9fa; }
            .sidebar { min-height: 100vh; background-color: #25343F; color: white; }
            .sidebar .nav-link { color: #rgba(255,255,255,.75); margin-bottom: 5px; }
            .sidebar .nav-link:hover, .sidebar .nav-link.active { color: white; background-color: #343a40; border-radius: 5px; }
        </style>
    </head>
    <body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2 sidebar p-3 d-flex flex-column justify-content-between">
                <div>
                    <h4 class="text-center fw-bold text-success mb-4">TEFA INVENTORY</h4>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('barang.index') }}" class="nav-link {{ Request::is('barang*') ? 'active' : '' }}">Kelola Barang</a>
                        </li>

                        @if(auth()->user()->role == 'admin')
                        <li class="nav-item">
                            <a href="{{ route('peminjam.index') }}" class="nav-link {{ Request::is('peminjam*') ? 'active' : '' }}">Kelola Peminjam</a>
                        </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{ route('peminjaman.index') }}" class="nav-link {{ Request::is('peminjaman*') ? 'active' : '' }}">Transaksi Peminjaman</a>
                        </li>
                    </ul>

                </div>

                <div>
                    <hr>
                    <div class="small mb-2 text-muted">Login sebagai: <strong class="text-white">{{ strtoupper(auth()->user()->role) }}</strong></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger w-100">Logout</button>
                    </form>
                </div>
            </div>

            <div class="col-md-9 col-lg-10 p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script sub="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
