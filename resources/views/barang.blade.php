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
        <form id="formBarang" action="{{route('barang.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row g-3">
            <div class="col-md-3">
              <label for="kode_barang" class="form-label">Kode Kue</label>
              <input type="text" class="form-control" id="kode_barang" name="kode" required>
            </div>
            <div class="col-md-3">
              <label for="nama_barang" class="form-label">Nama Kue</label>
              <input type="text" class="form-control" id="nama_barang" name="nama" required>
            </div>
            <div class="col-md-3">
              <label for="harga" class="form-label">Harga</label>
              <input type="number" class="form-control" id="harga" name="harga" required>
            </div>
            <div class="col-md-3">
              <label for="stok" class="form-label">Stok</label>
              <input type="number" class="form-control" id="stok" name="stok" required>
            </div>
            <div class="col-md-3">
              <label for="gambar" class="form-label">Gambar</label>
              <input type="file" class="form-control" id="gambar" name="gambar" required>
            </div>
          </div>
          <div class="mt-3">
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Tabel Data Barang -->
    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
          <tr>
            <th class="text-center">No</th>
            <th class="text-center">Kode</th>
            <th class="text-center">Nama Kue</th>
            <th class="text-center">Harga</th>
            <th class="text-center">Stok</th>
            <th class="text-center">Gambar</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <!-- Contoh data statis -->
          @foreach ($barang as $num => $row)
          <tr>
            <td class="text-center">{{$num+1}}</td>
            <td class="text-center">{{$row->kode}}</td>
            <td class="text-center">{{$row->nama}}</td>
            <td class="text-center">Rp {{ number_format($row->harga, 0, ',', '.') }}</td>
            <td class="text-center">{{$row->stok}}</td>
            <td class="text-center"> <img src="{{ asset('storage/kue/' . $row->gambar) }}" alt="" style="max-height: 150px; max-width: 250px;"></td>
            <td class="text-center">
              <a href="{{route('barang.edit',$row->id)}}" class="btn btn-sm btn-warning m-2"> Edit </a>
              <form action="{{route('barang.destroy',$row->id)}}" method="POST">
                @csrf
                @method('delete')
                <button class="btn btn-sm btn-danger">Hapus</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="{{asset('assets/bootstrap.bundle.min.js')}}"></script>
</body>

</html>