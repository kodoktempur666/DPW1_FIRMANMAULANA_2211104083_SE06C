<?php
session_start();
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $role_id = $_POST['role_id'];
    $full_name = $_POST['nama_lengkap'];
    $phone = $_POST['no_hp'];
    $email = $_POST['email'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    // Query untuk mengubah data pengguna
    if ($password) {
        $query = "UPDATE user SET role_id = ?, nama_lengkap = ?, no_hp = ?, email = ?, password = ? WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("issssi", $role_id, $full_name, $phone, $email, $password, $user_id);
    } else {
        $query = "UPDATE user SET role_id = ?, nama_lengkap = ?, no_hp = ?, email = ? WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isssi", $role_id, $full_name, $phone, $email, $user_id);
    }

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Pengguna berhasil diubah.";
    } else {
        $_SESSION['error_message'] = "Terjadi kesalahan saat mengubah pengguna.";
    }

    header("Location: user.php");
    exit();
}
?>
