<?php
session_start();
include '../connect.php';

// Pastikan pengguna memiliki hak akses
$query = "SELECT * FROM user JOIN role ON user.role_id = role.role_id WHERE user.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data['name'] !== 'admin' && $data['name'] !== 'penjual') {
    header("Location: dilarang.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaksi_id = $_POST['transaksi_id'];
    $user_id = $_POST['user_id'];
    $produk_id = $_POST['produk_id'];
    $quantity = $_POST['quantity'];

    $query = "UPDATE transaksi SET user_id = ?, produk_id = ?, quantity = ? WHERE transaksi_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiii", $user_id, $produk_id, $quantity, $transaksi_id);

    if ($stmt->execute()) {
        header("Location: transaksi.php");
    } else {
        echo "Gagal mengubah data";
    }
    $stmt->close();
}

$conn->close();
?>
