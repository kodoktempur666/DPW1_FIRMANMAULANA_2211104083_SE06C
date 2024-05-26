<?php
session_start();
include '../connect.php';
$query = "SELECT * FROM user JOIN role ON user.role_id = role.role_id WHERE user.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// Jika nama role bukan admin atau penjual maka dialihkan ke ../index.php
if ($data['name'] !== 'admin' && $data['name'] !== 'penjual') {
    header("Location: dilarang.php");
    exit;
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Transaksi</title>
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
                            <a class="nav-link" href="index.php">Riwayat Pembelian</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="produk.php">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="transaksi.php">Transaksi</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <h2>Transaksi</h2>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Transaksi</th>
                                <th>ID Pengguna</th>
                                <th>ID Produk</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM transaksi";
                            $result = $conn->query($query);
                            // Menampilkan data transaksi
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['transaksi_id'] . "</td>";
                                echo "<td>" . $row['user_id'] . "</td>";
                                echo "<td>" . $row['produk_id'] . "</td>";
                                echo "<td>" . $row['quantity'] . "</td>";
                                echo "<td>" . $row['tanggal'] . "</td>";
                                echo "<td>
                                        <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editDataModal{$row['transaksi_id']}'>Edit</button>
                                        <button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#hapusDataModal{$row['transaksi_id']}'>Hapus</button>
                                      </td>";
                                echo "</tr>";

                                // Modal ubah data
                                echo "<div class='modal fade' id='editDataModal{$row['transaksi_id']}' tabindex='-1' role='dialog' aria-labelledby='editDataModalLabel{$row['transaksi_id']}' aria-hidden='true'>
                                        <div class='modal-dialog' role='document'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='editDataModalLabel{$row['transaksi_id']}'>Ubah Data Transaksi</h5>
                                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                        <span aria-hidden='true'>&times;</span>
                                                    </button>
                                                </div>
                                                <form method='POST' action='transaksi/ubah.php'>
                                                    <div class='modal-body'>
                                                        <input type='hidden' name='transaksi_id' value='{$row['transaksi_id']}'>
                                                        <div class='form-group'>
                                                            <label for='user_id'>ID Pengguna</label>
                                                            <input required type='text' class='form-control' id='user_id' name='user_id' value='{$row['user_id']}'>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label for='produk_id'>ID Produk</label>
                                                            <input required type='text' class='form-control' id='produk_id' name='produk_id' value='{$row['produk_id']}'>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label for='quantity'>Jumlah</label>
                                                            <input required type='number' class='form-control' id='quantity' name='quantity' value='{$row['quantity']}'>
                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Tutup</button>
                                                        <button type='submit' class='btn btn-primary'>Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>";

                                // Modal Hapus Data
                                echo "<div class='modal fade' id='hapusDataModal{$row['transaksi_id']}' tabindex='-1' role='dialog' aria-labelledby='hapusDataModalLabel{$row['transaksi_id']}' aria-hidden='true'>
                                        <div class='modal-dialog' role='document'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='hapusDataModalLabel{$row['transaksi_id']}'>Konfirmasi Penghapusan</h5>
                                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                        <span aria-hidden='true'>&times;</span>
                                                    </button>
                                                </div>
                                                <div class='modal-body'>
                                                    Apakah Anda yakin ingin menghapus data transaksi ini?
                                                </div>
                                                <div class='modal-footer'>
                                                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Batal</button>
                                                    <a href='transaksi/hapus.php?id={$row['transaksi_id']}' class='btn btn-danger'>Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
