<?php
// Memulai session
session_start();
// Cek apakah pengguna sudah masuk
if (isset($_SESSION['username'])) {
        echo "Selamat datang, " . $_SESSION['username'] . "!";
        echo "<br><a href='logout.php'>Keluar</a>";
    } else { ?>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 320px;
        max-width: 100%;
    }

    .container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .container form input[type="text"],
    .container form input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .container form input[type="submit"] {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #4caf50;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .container form input[type="submit"]:hover {
        background-color: #45a049;
    }

    .container form .error {
        color: #ff0000;
        margin-bottom: 15px;
        text-align: center;
    }
    </style>
</head>
    <body>
        <div class="container">
            <h2>Login</h2>
            <form action="login1.php" method="post">
                <?php if (!empty($errorMessage)) { ?>
                    <p class="error"><?php echo $errorMessage; ?></p>
                <?php } ?>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
            </form>
        </div>
    </body>    
<?php   }





