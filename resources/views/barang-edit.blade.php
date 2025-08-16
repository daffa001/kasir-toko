<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Kelola Kue - Toko Kue</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="{{asset('assets/bootstrap.min.css')}}" rel="stylesheet">
</head>

<body>
  <!-- Navbar -->
  @include('layouts.navbar')

  <!-- Konten -->
  <div class="container py-4">
    <h4 class="mb-4">Kelola Data Kue</h4>

    <!-- Form Tambah/Edit Barang -->
    <div class="card mb-4">
      <div class="card-header">Form Kue</div>
      <div class="card-body">
        <form id="formBarang" action="{{route('barang.update',$barang->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="row g-3">
            <div class="col-md-3">
              <label for="kode_barang" class="form-label">Kode Barang</label>
              <input type="text" class="form-control" id="kode_barang" name="kode" value="{{$barang->kode}}" required>
            </div>
            <div class="col-md-3">
              <label for="nama_barang" class="form-label">Nama Kue</label>
              <input type="text" class="form-control" id="nama_barang" name="nama" value="{{$barang->nama}}" required>
            </div>
            <div class="col-md-3">
              <label for="harga" class="form-label">Harga</label>
              <input type="number" class="form-control" id="harga" name="harga" value="{{$barang->harga}}" required>
            </div>
            <div class="col-md-3">
              <label for="stok" class="form-label">Stok</label>
              <input type="number" class="form-control" id="stok" name="stok" value="{{$barang->stok}}" required>
            </div>
            <div class="col-md-3">
              <label for="gambar" class="form-label">Gambar</label>
              <input type="file" class="form-control" id="gambar" name="gambar">

              @if($barang->gambar)
              <div class="mt-2">
                <img src="{{ asset('storage/kue/' . $barang->gambar) }}"
                  alt="Gambar Barang"
                  style="max-height: 150px; max-width: 200px;">
              </div>
              @endif
            </div>
          </div>
          <div class="mt-3">
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="{{asset('assets/bootstrap.bundle.min.js')}}"></script>
</body>

</html>