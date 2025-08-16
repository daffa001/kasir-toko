<style>
    .bg-pink {
        background-color: pink !important;
    }

    .navbar-pink .navbar-brand,
    .navbar-pink .nav-link,
    .navbar-pink .text-custom {
        color: #4a0000 !important;
        /* maroon gelap biar kontras */
    }

    .navbar-pink .btn-outline-light {
        color: #4a0000;
        border-color: #4a0000;
    }

    .navbar-pink .btn-outline-light:hover {
        background-color: #4a0000;
        color: #fff;
    }
</style>

<nav class="navbar navbar-expand-lg bg-pink navbar-pink">
    <div class="container-fluid">
        <span class="navbar-brand">Khaica.Cake</span>
        <div class="ms-auto d-flex align-items-center text-custom">
            <a href="{{route('kasir.index')}}" class="btn btn-outline-light btn-sm">Transaksi</a>
            <a href="{{route('barang.index')}}" class="btn btn-outline-light btn-sm m-2">Kue</a>
            <a href="{{route('Login.create')}}" class="btn btn-outline-light btn-sm m-2">Logout</a>
        </div>
    </div>
</nav>