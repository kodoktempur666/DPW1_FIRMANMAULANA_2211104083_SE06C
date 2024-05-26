<?php
session_start();
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role_id = $_POST['role_id'];
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password

    // Query untuk menambah data pengguna
    $query = "INSERT INTO user (role_id, full_name, phone, email, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issss", $role_id, $full_name, $phone, $email, $password);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Pengguna berhasil ditambahkan.";
    } else {
        $_SESSION['error_message'] = "Terjadi kesalahan saat menambahkan pengguna.";
    }

    header("Location: user.php");
    exit();
}
?>
