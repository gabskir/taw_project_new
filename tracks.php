<?php
include 'config.php';
$tracks = $conn->query("SELECT * FROM tracks");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tracks</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Tracks</h1>
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
        <ul>
            <?php while($track = $tracks->fetch_assoc()): ?>
            <li><?php echo $track['name']; ?> - <?php echo $track['description']; ?></li>
            <?php endwhile; ?>
        </ul>
    </main>
    <footer>
        <p>&copy; 2024 Scientific Conference</p>
    </footer>
</body>
</html>
