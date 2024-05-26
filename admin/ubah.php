<?php
session_start();
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari inputan user
    $produk_id = $_POST['produk_id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Mengubah data menggunakan query SQL dengan prepared statements untuk mencegah SQL injection
    $query = "UPDATE produk SET nama = ?, harga = ?, stok = ? WHERE produk_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('siii', $nama, $harga, $stok, $produk_id);

    // Jika berhasil maka dialihkan ke halaman produk
    if ($stmt->execute()) {
        header("Location: produk.php");
        exit;
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    // Menutup statement
    $stmt->close();
}

// Menutup koneksi
$conn->close();
?>
