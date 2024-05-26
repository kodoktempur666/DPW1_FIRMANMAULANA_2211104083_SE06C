<?php
session_start();
include '../connect.php';

// Query untuk mengambil semua data pengguna
$query = "SELECT user.user_id, user.nama_lengkap, user.no_hp, user.email, role.name AS role_name FROM user JOIN role ON user.role_id = role.role_id";
$result = $conn->query($query);
?>
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
                            <a class="nav-link active" href="index.php">Riwayat Pembelian</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user.php">Pengguna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="produk.php">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../register.php">Register</a>
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
                    <h2>Pengguna</h2>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahDataModal">
                        Tambah Data
                    </button>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Nama Lengkap</th>
                                <th>No. HP</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['role_name'] ?></td>
                                <td><?= $row['nama_lengkap'] ?></td>
                                <td><?= $row['no_hp'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editDataModal<?= $row['user_id'] ?>">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusDataModal<?= $row['user_id'] ?>">Hapus</button>
                                </td>
                            </tr>
                            <!-- Modal ubah data -->
                            <div class="modal fade" id="editDataModal<?= $row['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editDataModalLabel<?= $row['user_id'] ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editDataModalLabel<?= $row['user_id'] ?>">Ubah Data Pengguna</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="ubah_user.php">
                                            <div class="modal-body">
                                                <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                                                <div class="form-group">
                                                    <label for="role">Role</label>
                                                    <select class="form-control" id="role" name="role_id">
                                                        <option value="1" <?= $row['role_name'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                                        <option value="2" <?= $row['role_name'] == 'Penjual' ? 'selected' : '' ?>>Penjual</option>
                                                        <option value="3" <?= $row['role_name'] == 'User' ? 'selected' : '' ?>>User</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="full_name">Nama Lengkap</label>
                                                    <input required type="text" class="form-control" id="full_name" name="nama_lengkap" value="<?= $row['nama_lengkap'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">No. HP</label>
                                                    <input required type="text" class="form-control" id="phone" name="no_hp" value="<?= $row['no_hp'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input required type="email" class="form-control" id="email" name="email" value="<?= $row['email'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Hapus Data -->
                            <div class="modal fade" id="hapusDataModal<?= $row['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="hapusDataModalLabel<?= $row['user_id'] ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="hapusDataModalLabel<?= $row['user_id'] ?>">Konfirmasi Penghapusan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data pengguna ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <a href="hapus_user.php?id=<?= $row['user_id'] ?>" class="btn btn-danger">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <!-- Modal tambah data -->
    <div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="tambah_user.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role_id">
                                <option value="1">Admin</option>
                                <option value="2">Penjual</option>
                                <option value="3">User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="full_name">Nama Lengkap</label>
                            <input required type="text" class="form-control" id="full_name" name="full_name">
                        </div>
                        <div class="form-group">
                            <label for="phone">No. HP</label>
                            <input required type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input required type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input required type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
