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

if (isset($_GET['id'])) {
    $transaksi_id = $_GET['id'];

    $query = "DELETE FROM transaksi WHERE transaksi_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $transaksi_id);

    if ($stmt->execute()) {
        header("Location: transaksi.php");
    } else {
        echo "Gagal menghapus data";
    }
    $stmt->close();
}

$conn->close();
?>
