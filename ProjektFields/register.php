<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Regjistrimi u krye me sukses!'); window.location.href='login.php';</script>";
    } else {
        echo "Gabim: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Regjistrim - SportFields</title>
    <link rel="stylesheet" href="styleregister.css">
</head>
<body>

<div class="registration-container">
    <h2>Regjistrohu në SportFields</h2>
    <form method="POST" action="" class="registration-form">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Fjalëkalimi" required>
        <button type="submit" class="btn">Regjistrohu</button>
    </form>
    <p class="login-link">Keni një llogari? <a href="login.php">Kyçu këtu</a>.</p>
</div>

</body>
</html>
