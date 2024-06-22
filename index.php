<?php
include 'config.php';

// Fetch conference details
$conference = $conn->query("SELECT * FROM conference WHERE id = 1")->fetch_assoc();

// Fetch the most liked articles
$most_liked_articles = $conn->query("SELECT * FROM articles ORDER BY likes DESC LIMIT 3");

// Collect authors from the most liked articles
$authors = [];
$articles_with_authors = [];
while ($article = $most_liked_articles->fetch_assoc()) {
    $article_authors = explode(',', $article['authors']);
    foreach ($article_authors as $author) {
        $author = trim($author);
        if (!array_key_exists($author, $authors)) {
            $authors[$author] = [
                'title' => $article['title'],
                'image_url' => $article['image_url']
            ];
            $articles_with_authors[] = $article;
            if (count($authors) >= 4) break 2; // Limit to 4 unique authors
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $conference['name']; ?></title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <header class="main-header">
        <div class="header-content">
            <div class="logo">
                <h1><?php echo $conference['name']; ?></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="location.php">Location</a></li>
                    <li><a href="info.php">Information</a></li>
                    <li><a href="articles.php">Articles</a></li>
                    <li><a href="schedule.php">Schedule</a></li>
                    <li><a href="tracks.php">Tracks</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
                <div class="account-icon">
                    <a href="login.php"><img src="imgs/account-icon.png" alt="Account"></a>
                </div>
            </nav>
        </div>
        <div class="intro">
            <div class="intro-text">
                <h2>Discover Cutting-edge Research and Innovations</h2>
                <p>Join us for the <?php echo $conference['name']; ?> where leading experts in the field of machine learning gather to share their latest research and developments. Network with professionals, attend insightful sessions, and expand your knowledge!</p>
            </div>
            <div class="intro-image">
                <img src="imgs/intro-image.png" alt="Intro Image">
            </div>
        </div>
    </header>
    <main>
        <section class="keynote-speakers">
            <h2>Keynote Speakers</h2>
            <div class="speakers">
                <?php foreach ($authors as $author => $details): ?>
                <div class="speaker">
                    <img src="<?php echo $details['image_url']; ?>" alt="<?php echo $author; ?>">
                    <h3><?php echo $author; ?></h3>
                    <p><?php echo $details['title']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="featured-articles">
            <h2>Featured Articles</h2>
            <div class="articles">
                <?php foreach ($articles_with_authors as $article): ?>
                <div class="article">
                    <h3><a href="#" onclick="showArticleDetails(<?php echo $article['id']; ?>)"><?php echo $article['title']; ?></a></h3>
                    <p><?php echo substr($article['description'], 0, 100); ?>...</p>
                    <div class="article-footer">
                        <button onclick="upvoteArticle(<?php echo $article['id']; ?>)">Upvote</button>
                        <span><?php echo $article['likes']; ?> likes</span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <a href="articles.php" class="more-button">More Articles</a>
        </section>
        <section class="testimonials">
            <h2>What Attendees Say</h2>
            <blockquote>
                "This conference is a must-attend for anyone in the field. The sessions are insightful and the networking opportunities are invaluable."
                <cite>- Dr. Alice Johnson</cite>
            </blockquote>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Scientific Conference</p>
        <div class="social-media">
            <a href="#"><img src="imgs/facebook.png" alt="Facebook"></a>
            <a href="#"><img src="imgs/twitter.png" alt="Twitter"></a>
            <a href="#"><img src="imgs/linkedin.png" alt="LinkedIn"></a>
        </div>
    </footer>
    <div id="article-popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <div id="article-details"></div>
        </div>
    </div>
</body>
</html>