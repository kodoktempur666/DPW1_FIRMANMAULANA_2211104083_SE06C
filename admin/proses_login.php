
<?php
// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start(); // Memulai session
    // Lakukan operasi pengecekan login di database
    require_once('../connect.php');
    
    // Query untuk memeriksa kecocokan email dan password di tabel pengguna
    $query = "SELECT * FROM user WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $_POST['email'], $_POST['password']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Login berhasil, simpan data pengguna ke dalam session
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        $_SESSION['role_id'] = $user['role_id']; // Simpan role_id ke dalam session
        
        // Login berhasil, redirect ke halaman utama
        header("Location: index.php");
        exit();
    } else {
        echo "Login gagal. Silahkan cek kembali email dan password Anda.";
    }

    // Tutup koneksi database
    $stmt->close();
    $conn->close();
}
?>
