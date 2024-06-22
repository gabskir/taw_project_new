<?php
include 'config.php';
session_start();

// Fetch conference details
$conference = $conn->query("SELECT * FROM conference WHERE id = 1")->fetch_assoc();

// Initialize variables
$search_query = "";
$search_result = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search_query = $_POST['search'];
    $stmt = $conn->prepare("SELECT articles.*, tracks.name AS track_name FROM articles 
                            JOIN tracks ON articles.track_id = tracks.id
                            WHERE articles.title LIKE ? OR articles.authors LIKE ?");
    $search_term = "%" . $search_query . "%";
    $stmt->bind_param("ss", $search_term, $search_term);
    $stmt->execute();
    $search_result = $stmt->get_result();
} else {
    $search_result = $conn->query("SELECT articles.*, tracks.name AS track_name FROM articles 
                                   JOIN tracks ON articles.track_id = tracks.id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Articles</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <div class="wrapper">
        <?php include 'header.php'; ?>
        <main>
            <div class="main-container">
                <div class="article-header">
                    <h2>Articles</h2>
                    <form action="articles.php" method="post" class="search-form">
                        <input type="text" name="search" placeholder="Search by title or author" value="<?php echo htmlspecialchars($search_query); ?>">
                        <input type="submit" value="Search">
                    </form>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Authors</th>
                            <th>Track</th>
                            <th>Likes</th>
                            <th>Upvote</th>
                            <th>PDF</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $search_result->fetch_assoc()): ?>
                        <tr>
                            <td><a href="article_detail.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></td>
                            <td><?php echo $row['authors']; ?></td>
                            <td><?php echo $row['track_name']; ?></td>
                            <td id="likes-<?php echo $row['id']; ?>"><?php echo $row['likes']; ?></td>
                            <td><button class="upvote-btn" data-article-id="<?php echo $row['id']; ?>">Upvote</button></td>
                            <td><a href="<?php echo $row['pdf_link']; ?>" target="_blank">View PDF</a></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>
