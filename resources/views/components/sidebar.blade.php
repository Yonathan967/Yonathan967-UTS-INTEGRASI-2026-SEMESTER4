<aside class="sidebar"
      style="background-image: url('{{ url('/halaman_depan/images/background.jpeg') }}')">

    <!-- WRAPPER DI SINI -->
    <div class="sidebar-header">
        <img src="{{ asset('halaman_depan/images/icons/logo_reece.ico') }}"
             class="logo"
             alt="Logo Reece Farms">
        <span class="brand-text">Reece Farms</span>
    </div>

    @if(auth()->user()->role === 'admin')
        <ul class="menu">
            <li><a href="/admin/dashboard">Dashboard</a></li>
            <li><a href="/admin/penjualan">Penjualan</a></li>
            <li><a href="/admin/kelola-akun">Kelola Akun Pegawai</a></li>
            <li><a href="/admin/laporan">Laporan</a></li>
            <li><a href="/user/penanaman">Penanaman</a></li>
            <li><a href="/user/perawatan">Perawatan</a></li>
            <li><a href="/user/pemanenan">Pemanenan</a></li>
        </ul>
    @endif

    @if(auth()->user()->role === 'user')
        <ul class="menu">
            <li><a href="/user/dashboard">Dashboard</a></li>
            <li><a href="/user/penanaman">Penanaman</a></li>
            <li><a href="/user/perawatan">Perawatan</a></li>
            <li><a href="/user/pemanenan">Pemanenan</a></li>
        </ul>
    @endif

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <div class="logout">
            <button>Keluar</button>
        </div>
    </form>

</aside>
