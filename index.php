<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JS CAFE</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('header.php'); ?>
    
    <main>
        <h1>Selamat datang di JS CAFE</h1>
        <p>Nikmati suasana yang nyaman dan hidangan lezat!</p>
        <div class="menu">
            <h2>Menu</h2>
            <ul>
                <li>Nasi Goreng - Rp 25.000</li>
                <li>Mie Goreng - Rp 20.000</li>
                <li>Kopi - Rp 15.000</li>
                <li>Teh - Rp 10.000</li>
            </ul>
            <h2>Reservasi online</h2>
            <form action="result.php" method="POST">
                <input type="text" name="name" placeholder="Nama"><br><br>
                <input type="time" name="Jam" placeholder="Jam">
                <input type="text" name="Jumlah" placeholder="Jumlah"><br><br>
                <label for="file">Upload bukti pembayaran dp:</label><br>
                <input type="file" id="file" name="file"><br><br>
                <button type="submit" name="submit">Kirim</button>
        </form>
        </div>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>
