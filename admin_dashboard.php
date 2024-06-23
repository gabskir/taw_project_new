<?php
include 'config.php';
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: profile.php');
    exit();
}

echo "Welcome, ", htmlspecialchars($_SESSION['username']) ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <nav>
        <a href="index.php">Go Back to HomePage</a></li>
        <ul>
            <li><a href="edit_general_info.php">Edit General Info</a></li>
            <li><a href="edit_articles.php">Edit Articles</a></li>
            <li><a href="edit_program.php">Edit Program/Timetable</a></li>
        </ul>
    </nav>
</body>
</html>
