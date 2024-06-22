<?php
include 'config.php';
$article_id = $_GET['id'];
$article = $conn->query("SELECT * FROM articles WHERE id = $article_id")->fetch_assoc();
$questions = $conn->query("SELECT * FROM questions WHERE article_id = $article_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $article['title']; ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1><?php echo $article['title']; ?></h1>
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
        <h2>Authors: <?php echo $article['authors']; ?></h2>
        <p><a href="<?php echo $article['pdf_link']; ?>" target="_blank">View PDF</a></p>
        
        <h3>Questions</h3>
        <ul>
            <?php while($question = $questions->fetch_assoc()): ?>
            <li><?php echo $question['question']; ?></li>
            <?php endwhile; ?>
        </ul>
        
        <h3>Ask a Question</h3>
        <form action="ask_question.php" method="post">
            <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
            <textarea name="question" required></textarea>
            <button type="submit">Submit</button>
        </form>
        
        <h3>Vote</h3>
        <form action="vote.php" method="post">
            <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
            <button type="submit" name="vote" value="1">Upvote</button>
            <button type="submit" name="vote" value="0">Downvote</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Scientific Conference</p>
    </footer>
</body>
</html>
