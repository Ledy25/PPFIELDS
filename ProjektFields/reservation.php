<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $field = mysqli_real_escape_string($conn, $_POST['field']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $sql = "INSERT INTO reservations (name, field, date, time, phone)
            VALUES ('$name', '$field', '$date', '$time', '$phone')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Rezervimi u bë me sukses!'); window.location.href='reservation.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Rezervim - SportFields</title>
  <link rel="stylesheet" href="stylereserve.css"/>
</head>
<body>

<header>
  <div class="logo">SportFields</div>
  <nav>
    <a href="index.html">Home</a>
    <a href="about.html">About</a>
    <a href="fields.html">Fields</a>
    <a href="reservation.php">Reserve</a>
    <a href="contact.html">Contact</a>
  </nav>
</header>

<main class="reservation-main">
  <h2>Rezervo një fushë</h2>
  <form method="POST" action="reservation.php" id="reservationForm" class="reservation-form">
    
    <label for="name">Emri i plotë:</label>
    <input type="text" id="name" name="name" required>

    <label for="phone">Numri i telefonit:</label>
    <input type="tel" id="phone" name="phone"  placeholder="Vendos numrin ">

    <label for="field">Zgjidh fushën:</label>
    <select id="field" name="field" required>
      <option value="">Zgjidh një fushë</option>
      <option value="Fusha e Futbollit">Fusha e Futbollit - Vushtrri</option>
      <option value="Fusha e Basketbollit">Fusha e Basketbollit - Prishtina</option>
      <option value="Fusha e Volejbollit">Fusha e Volejbollit - Prishtina</option>
    </select>

    <label for="date">Data:</label>
    <input type="date" id="date" name="date" required>

    <label for="time">Ora:</label>
    <input type="time" id="time" name="time" required>

    <button type="submit" class="btn">Rezervo Tani</button>

  </form>
</main>

<footer>
  <p>&copy; 2025 SportFields. Të gjitha të drejtat e rezervuara.</p>
</footer>

</body>
</html>
