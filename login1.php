
<!DOCTYPE html>
<html>
<head>
    <title>Form Upload</title><?php
// File: login.php
// Memulai session
session_start();
// Cek apakah username dan password sesuai
if ($_POST['username'] == 'sureal' && $_POST['password'] == 'sureal'){ 
// Menyimpan username dalam session
    $_SESSION['username'] = $_POST['username'];
    echo "Berhasil masuk!";
    echo "<br><a href='index1.php'>Kembali ke halaman utama</a>";
} else {
    echo "Gagal masuk. Silakan coba lagi.";
    echo "<br><a href='index1.php'>Kembali ke halaman masuk</a>";
}
?>
</head>
<body>
    <h2>Upload File Gambar</h2>
    <?php if (!empty($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        Pilih file untuk diupload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Gambar" name="submit">
    </form>
</body>
</html>