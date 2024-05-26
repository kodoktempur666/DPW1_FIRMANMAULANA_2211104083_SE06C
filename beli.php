<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produk_id = $_POST['produk_id'];
    $quantity = $_POST['quantity'];

    // Ambil data produk berdasarkan produk_id
    $query_produk = "SELECT * FROM produk WHERE produk_id = ?";
    $stmt_produk = $conn->prepare($query_produk);
    $stmt_produk->bind_param("i", $produk_id);
    $stmt_produk->execute();
    $result_produk = $stmt_produk->get_result();
    $produk = $result_produk->fetch_assoc();

    // Validasi apakah stok mencukupi
    if ($produk['stok'] >= $quantity) {
        // Kurangi stok barang
        $new_stock = $produk['stok'] - $quantity;
        $query_update_stock = "UPDATE produk SET stok = ? WHERE produk_id = ?";
        $stmt_update_stock = $conn->prepare($query_update_stock);
        $stmt_update_stock->bind_param("ii", $new_stock, $produk_id);
        $stmt_update_stock->execute();

        // Simpan data transaksi
        $query_insert_transaksi = "INSERT INTO transaksi (user_id, produk_id, quantity) VALUES (?, ?, ?)";
        $stmt_insert_transaksi = $conn->prepare($query_insert_transaksi);
        $stmt_insert_transaksi->bind_param("iii", $_SESSION['user_id'], $produk_id, $quantity);
        $stmt_insert_transaksi->execute();

        // Redirect kembali ke halaman sebelumnya atau halaman sukses
        header("Location: index.php");
        exit();
    } else {
        // Jika stok tidak mencukupi
        $_SESSION['error_message'] = "Stok tidak mencukupi untuk produk ini.";
        header("Location: index.php");
        exit();
    }
}
?>
