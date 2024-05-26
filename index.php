<?php
session_start();
include 'connect.php';
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}


$email = $_SESSION['email'];
// Query untuk mengambil semua data produk
$query = "SELECT * FROM produk";
$result = $conn->query($query);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contoh Website</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <h1>Logo</h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/produk.php">Product</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Card Produk -->
    <div class="container mt-5">
            <li class="nav-item">
                <span class="navbar-text">
                login sebagai: <?php echo $email; ?>
                </span>
                <a class="nav-link" href="login.php">LOGOUT</a>
            </li>
        <div class="container">
        <h1>Welcome to the Index Page</h1>
        </div>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                    <img src="https://picsum.photos/150/150" class="card-img-top" alt="Gambar Produk 2">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['nama'] ?></h5>
                            <p class="card-text">Harga: <?= $row['harga'] ?> | Stok: <?= $row['stok'] ?></p>
                            <form method="POST" action="beli.php">
                                <input type="hidden" name="produk_id" value="<?= $row['produk_id'] ?>">
                                <input type="number" name="quantity" value="1" min="1" max="<?= $row['stok'] ?>" required>
                                <button type="submit" class="btn btn-primary btn-sm">Beli</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
