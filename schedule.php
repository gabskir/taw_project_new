<?php
include 'config.php';
$schedule = $conn->query("SELECT schedule.*, tracks.name as track_name, articles.title as article_title 
                          FROM schedule 
                          JOIN tracks ON schedule.track_id = tracks.id 
                          JOIN articles ON schedule.article_id = articles.id 
                          ORDER BY schedule.day, schedule.time");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Schedule</h1>
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
        <table>
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Room</th>
                    <th>Track</th>
                    <th>Article</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $schedule->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['day']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                    <td><?php echo $row['room']; ?></td>
                    <td><?php echo $row['track_name']; ?></td>
                    <td><a href="article_detail.php?id=<?php echo $row['article_id']; ?>"><?php echo $row['article_title']; ?></a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; 2024 Scientific Conference</p>
    </footer>
</body>
</html>
