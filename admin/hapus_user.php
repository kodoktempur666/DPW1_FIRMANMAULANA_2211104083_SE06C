<?php
session_start();
include '../connect.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Query untuk menghapus data transaksi terkait
        $queryTransaksi = "DELETE FROM transaksi WHERE user_id = ?";
        $stmtTransaksi = $conn->prepare($queryTransaksi);
        $stmtTransaksi->bind_param("i", $user_id);
        $stmtTransaksi->execute();

        // Query untuk menghapus data pengguna
        $queryUser = "DELETE FROM user WHERE user_id = ?";
        $stmtUser = $conn->prepare($queryUser);
        $stmtUser->bind_param("i", $user_id);
        $stmtUser->execute();

        // Commit transaksi
        $conn->commit();

        $_SESSION['success_message'] = "Pengguna dan transaksi terkait berhasil dihapus.";
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        $conn->rollback();
        $_SESSION['error_message'] = "Terjadi kesalahan saat menghapus pengguna dan transaksi terkait.";
    }

    header("Location: user.php");
    exit();
}
?>
