<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Transaksi - Toko Kue</title>
    <link href="{{asset('assets/bootstrap.min.css')}}" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Navbar -->
    @include('layouts.navbar')


    <!-- Main Content -->
    <div class="container my-4">
        <h4 class="mb-4">Transaksi Penjualan</h4>

        <div class="row">
            <!-- Kolom Kiri (8) -->
            <div class="col-md-8">

                <!-- Form Input Kue -->
                <form class="row g-3 mb-4" action="{{ route('kasir.add') }}" method="POST">
                    @csrf
                    <div class="col-md-6">
                        <label for="barang" class="form-label">Pilih Kue</label>
                        <select class="form-select" id="barang" name="barang" required>
                            <option selected disabled>Pilih Kue...</option>
                            @foreach ($barang as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100">Tambah</button>
                    </div>
                </form>

                <!-- Tabel Keranjang -->
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-striped">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Kue</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cart as $i => $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item['nama'] }}</td>
                                <td>Rp {{ number_format($item['harga']) }}</td>
                                <td class="text-center">{{ $item['jumlah'] }}</td>
                                <td>Rp {{ number_format($item['subtotal']) }}</td>
                                <td class="text-center">
                                    <form action="{{ route('kasir.hapus', $i) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Baris lain diisi dengan data dari session/database -->
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum Ada Kue atau Produk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Kolom Kanan (4) -->
            <div class="col-md-4">
                <div class="card p-4 shadow-sm">
                    <h5 class="mb-3">Ringkasan Pembayaran</h5>
                    <form action="{{ route('kasir.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="total_harga" id="InputTotal" value="{{ $total }}">
                        <div class="mb-3">
                            <label class="form-label">Total Belanja</label>
                            <input type="text" class="form-control text-end" value="Rp {{ number_format($total) }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Uang Dibayar</label>
                            <input type="number" class="form-control text-end" id="InputBayar" name="bayar" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kembalian</label>
                            <input type="text" class="form-control text-end" id="displayKembalian" value="Rp 0" readonly>
                            <input type="hidden" name="kembalian" id="InputKembalian">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-success" onclick="hitungKembalian()">Hitung Kembalian</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn" id="btnSimpan">Simpan Transaksi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{asset('assets/bootstrap.bundle.min.js')}}"></script>
    <script>
        const formatRupiah = n => new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(n);

        const hitungKembalian = () => {
            const total = +InputTotal.value || 0;
            const bayar = +InputBayar.value || 0;
            const kembalian = bayar - total;

            InputKembalian.value = kembalian;
            displayKembalian.value = formatRupiah(kembalian);
            btnSimpan.disabled = bayar <= total;
        };
    </script>


</body>

</html>