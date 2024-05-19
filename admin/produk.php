<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Riwayat Pembelian</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pengguna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Role</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Produk</h2>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahDataModal">
                        Tambah Data
                    </button>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Email Pengguna</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>john@example.com</td>
                                <td>Produk 1</td>
                                <td>$100</td>
                                <td>10</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editDataModal">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusDataModal">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>jane@example.com</td>
                                <td>Produk 2</td>
                                <td>$150</td>
                                <td>5</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editDataModal">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusDataModal">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>david@example.com</td>
                                <td>Produk 3</td>
                                <td>$80</td>
                                <td>8</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editDataModal">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusDataModal">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <!-- Modal ubah data -->
    <div class="modal fade" id="editDataModal" tabindex="-1" role="dialog" aria-labelledby="editDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDataModalLabel">Ubah Data Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input required type="text" class="form-control" id="nama">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input required type="number" class="form-control" id="harga">
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input required type="number" class="form-control" id="stok">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal tambah data -->
    <div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input required type="text" class="form-control" id="nama">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input required type="number" class="form-control" id="harga">
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input required type="number" class="form-control" id="stok">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal hapus data -->
    <div class="modal fade" id="hapusDataModal" tabindex="-1" role="dialog" aria-labelledby="hapusDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusDataModalLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data produk ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
