<?php
include 'config.php';

// Fetch conference details
$conference = $conn->query("SELECT * FROM conference WHERE id = 1")->fetch_assoc();

// Fetch tracks and their associated articles
$tracks = $conn->query("SELECT * FROM tracks");

$tracks_with_articles = [];
while ($track = $tracks->fetch_assoc()) {
    $track_id = $track['id'];
    $articles = $conn->query("SELECT * FROM articles WHERE track_id = $track_id");
    $track['articles'] = $articles->fetch_all(MYSQLI_ASSOC);
    $tracks_with_articles[] = $track;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tracks</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/tracks.css">
</head>
<body>
    <div class="wrapper">
        <?php include 'header.php'; ?>
        <main>
            <div class="main-container">
                <h2>Tracks</h2>
                <?php foreach ($tracks_with_articles as $track): ?>
                    <section class="track">
                        <h3><?php echo htmlspecialchars($track['name']); ?></h3>
                        <p><?php echo htmlspecialchars($track['description']); ?></p>
                        <?php if (!empty($track['articles'])): ?>
                            <h4>Articles:</h4>
                            <ul>
                                <?php foreach ($track['articles'] as $article): ?>
                                    <li><a href="article_detail.php?id=<?php echo $article['id']; ?>"><?php echo htmlspecialchars($article['title']); ?></a> - <?php echo htmlspecialchars($article['authors']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>No articles available for this track.</p>
                        <?php endif; ?>
                    </section>
                <?php endforeach; ?>
            </div>
        </main>
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>
