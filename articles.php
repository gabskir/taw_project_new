<?php
include 'config.php';
$result = $conn->query("SELECT * FROM articles");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Articles</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Articles</h1>
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
                    <th>Title</th>
                    <th>Authors</th>
                    <th>PDF</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><a href="article_detail.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></td>
                    <td><?php echo $row['authors']; ?></td>
                    <td><a href="<?php echo $row['pdf_link']; ?>" target="_blank">View PDF</a></td>
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
