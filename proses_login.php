<?php
    // // Cek apakah form telah disubmit
    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     session_start(); // Memulai session
    //     // Lakukan operasi pengecekan login di database
    //     require_once('connect.php');
    //     // Query untuk memeriksa kecocokan email dan password di tabel pengguna
    //     // Buat query untuk mengecek apakah terdapat user dengan email X dan password Y, jika ya maka login berhasil
    //     $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    //     $result = $conn->query($query);
    //     if ($result->num_rows > 0) {
    //     // Login berhasil, simpan data pengguna ke dalam session
    //     $user = $result->fetch_assoc();
    //     // ISI_DISINI
    //     // Ubah X, Y, Z dengan session agar menyimpan data yang tadi berhasil login kedalam session
    //     $X = $user['user_id'];
    //     $Y = $user['email'];
    //     $Z = $user['nama_lengkap'];
    //     // Login berhasil, redirect ke halaman utama
    //     header("Location: index.php");
    //     exit();
    //     } else {
    //     echo "Login gagal. Silakan cek kembali email dan
    //     password Anda.";
    //     }
    // // Tutup koneksi database
    // $conn->close();
    // }
?>
<?php
session_start();
require_once('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mencari pengguna berdasarkan email
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Pengguna ditemukan, verifikasi password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password cocok, set session dan arahkan ke halaman index.php
            $_SESSION['email'] = $email;
            header("Location: index.php");
            exit();
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Email tidak ditemukan.";
    }

    $conn->close();
}
?>
