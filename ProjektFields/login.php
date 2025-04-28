<?php
include 'connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: index.html");
            }
            exit();
        } else {
            echo "<script>alert('Fjalëkalim i gabuar!');</script>";
        }
    } else {
        echo "<script>alert('Email nuk ekziston!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kyçu - SportFields</title>
    
    <link rel="stylesheet" href="stylellogin.css"> 
<body>

<div class="login-container">
    <h2>Kyçu në SportFields</h2>
    <form method="POST" action="" class="login-form">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Fjalëkalimi" required>
        <button type="submit" class="btn">Kyçu</button>
    </form>
    <p class="register-link">Nuk ke llogari? <a href="register.php">Regjistrohu këtu</a>.</p>
</div>

</body>
</html>
