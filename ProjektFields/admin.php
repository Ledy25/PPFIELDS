<?php
include 'connect.php';
session_start();


if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}


$sql = "SELECT * FROM reservations ORDER BY date, time";
$result = mysqli_query($conn, $sql);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
    $reservation_id = $_POST['reservation_id'];
    $status = $_POST['status'];

    
    $update_sql = "UPDATE reservations SET status='$status' WHERE id='$reservation_id'";
    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('Rezervimi u përditësua me sukses!');</script>";
        header("Location: admin.php"); 
        exit();
    } else {
        echo "Gabim: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - SportFields</title>
    <link rel="stylesheet" href="styleadmin.css">
</head>
<body>

<header>
    <div class="logo">SportFields - Admin Panel</div>
    <nav>
        <a href="logout.php" class="logout-btn">Dil</a>
    </nav>
</header>

<main>
    <h2>Lista e Rezervimeve</h2>
    <table>
        <thead>
            <tr>
                <th>Emri</th>
                <th>Fusha</th>
                <th>Data</th>
                <th>Ora</th>
                <th>Telefoni</th>
                <th>Statusi</th>
                <th>Konfirmo</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['field']); ?></td>
                <td><?php echo htmlspecialchars($row['date']); ?></td>
                <td><?php echo htmlspecialchars($row['time']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td>
                    <?php echo htmlspecialchars($row['status']); ?>
                </td>
                <td>
                    
                    <?php if ($row['status'] != 'CONFIRMED'): ?>
                        <form method="POST" action="">
                            <input type="hidden" name="reservation_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="status" value="CONFIRMED">
                            <button type="submit" name="confirm" class="btn-confirm">Konfirmo</button>
                        </form>
                    <?php else: ?>
                        <span>Konfirmuar</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<footer>
    <p>&copy; 2025 SportFields. Të gjitha të drejtat e rezervuara.</p>
</footer>

</body>
</html>
