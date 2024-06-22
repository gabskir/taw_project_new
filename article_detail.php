<?php
include 'config.php';
session_start();

$article_id = $_GET['id'];
$article = $conn->query("SELECT * FROM articles WHERE id = $article_id")->fetch_assoc();

// Fetch conference details
$conference = $conn->query("SELECT * FROM conference WHERE id = 1")->fetch_assoc();

// Fetch author names from the article
$author_names = explode(',', $article['authors']);
$author_picture_url = $article['image_url']; // Same URL for all authors

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($article['title']); ?></title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/article_detail.css">
</head>
<body>
    <div class="wrapper">
        <?php include 'header.php'; ?>
        <main>
            <div class="main-container">
                <h2><?php echo htmlspecialchars($article['title']); ?></h2>
                <div class="authors-votes">
                    <div class="authors">
                        <h3>Authors:</h3>
                        <?php foreach ($author_names as $author_name): ?>
                            <div class="author">
                                <img src="<?php echo htmlspecialchars($author_picture_url); ?>" alt="Author Picture" class="author-picture">
                                <p><?php echo htmlspecialchars(trim($author_name)); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="votes">
                        <h3>Votes</h3>
                        <p>Total Votes: <span id="total-votes"><?php echo $article['likes']; ?></span></p>
                        <?php if (isset($_SESSION['user_id'])): ?>
                        <form action="vote.php" method="post">
                            <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
                            <button type="submit" name="vote" value="1">Upvote</button>
                        </form>
                        <?php else: ?>
                        <p>You need to <a href="login.php">log in</a> to vote.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <p><?php echo htmlspecialchars($article['description']); ?></p>
                <p><a href="<?php echo htmlspecialchars($article['pdf_link']); ?>" target="_blank">View PDF</a></p>

                <h3>Ask a Question</h3>
                <?php if (isset($_SESSION['user_id'])): ?>
                <form action="ask_question.php" method="post">
                    <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
                    <textarea name="question" required></textarea>
                    <button type="submit">Submit</button>
                </form>
                <?php else: ?>
                <p>You need to <a href="login.php">log in</a> to ask a question.</p>
                <?php endif; ?>
            </div>
        </main>
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>
