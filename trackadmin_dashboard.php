<?php
include 'config.php';
session_start();

if ($_SESSION['role'] != 'trackadmin') {
    header('Location: login.php');
    exit();
}

echo "Welcome, TrackAdmin!";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TrackAdmin Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>TrackAdmin Dashboard</h1>
    <nav>
        <ul>
            <li><a href="edit_track.php">Edit Track Content</a></li>
        </ul>
    </nav>
</body>
</html>
