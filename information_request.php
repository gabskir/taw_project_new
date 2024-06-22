<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO info_requests (user_id, name, email, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $name, $email, $message);

    if ($stmt->execute()) {
        echo "Information request sent!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Contact Us</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="location.php">Location</a></li>
                <li><a href="info.php">Information</a></li>
                <li><a href="articles.php">Articles</a></li>
                <li><a href="schedule.php">Schedule</a></li>
                <li><a href="tracks.php">Tracks</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Send Us a Message</h2>
        <form action="contact.php" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" required>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <label for="message">Message:</label>
            <textarea name="message" required></textarea>
            <button type="submit">Send</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Scientific Conference</p>
    </footer>
</body>
</html>
