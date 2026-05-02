<?php
// 1. VERİLƏNLƏR BAZASINA QOŞULMA
$host = "localhost";
$username = "root";
$password = "";
$dbname = "contact_db";

// Bağlantı yaradırıq
$conn = new mysqli($host, $username, $password, $dbname);

// Bağlantını yoxlayırıq (Əgər baza yoxdursa xəta verəcək)
if ($conn->connect_error) {
    die("Bağlantı xətası: " . $conn->connect_error);
}

$status_mesaji = "";

// 2. FORMA GÖNDƏRİLDİKDƏ MƏLUMATI BAZAYA YAZMAQ
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formadan gələn məlumatları tuturuq
    $ad = $_POST['ad'];
    $email = $_POST['email'];
    $mesaj = $_POST['mesaj'];

    // SQL əmrini hazırlayırıq
    $sql = "INSERT INTO messages (name, email, message) VALUES ('$ad', '$email', '$mesaj')";

    if ($conn->query($sql) === TRUE) {
        $status_mesaji = "<p style='color:green; font-weight:bold;'>Məlumat uğurla bazaya yazıldı!</p>";
    } else {
        $status_mesaji = "<p style='color:red;'>Xəta: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <title>Məlumat Bazasına Qoşulan Forma</title>
    <style>
        body { font-family: sans-serif; margin: 50px; }
        form { background: #f4f4f4; padding: 20px; border-radius: 8px; width: 300px; }
        input, textarea { width: 100%; margin-bottom: 10px; padding: 8px; }
        button { background: blue; color: white; border: none; padding: 10px; cursor: pointer; width: 100%; }
    </style>
</head>
<body>

    <h2>Əlaqə Forması</h2>

    <!-- PHP-dən gələn cavabı burada göstəririk -->
    <?php echo $status_mesaji; ?>

    <form action="" method="POST">
        <label>Adınız:</label><br>
        <input type="text" name="ad" required><br>

        <label>E-poçtunuz:</label><br>
        <input type="email" name="email" required><br>

        <label>Mesajınız:</label><br>
        <textarea name="mesaj" rows="4" required></textarea><br>

        <button type="submit">Bazaya Göndər</button>
    </form>

</body>
</html>

<?php
// Bağlantını bağlayırıq
$conn->close();
?>