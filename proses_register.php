<?php
    // Cek apakah form telah disubmit
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lakukan operasi penyimpanan data ke database
        require_once('connect.php');
        
        // Ambil data dari form
        $role = $_POST['role'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $no_hp = $_POST['no_hp'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing the password for security

        // Query untuk menyimpan data pengguna baru ke tabel users
        $query = "INSERT INTO users (nama_lengkap, email, no_hp, password) VALUES ('$nama_lengkap', '$email', '$no_hp', '$password')";

        if ($conn->query($query) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
        
        // Tutup koneksi database
        $conn->close();
    }
?>

