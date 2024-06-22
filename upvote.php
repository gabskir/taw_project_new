<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'You need to be logged in to vote.']);
    exit();
}

$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents('php://input'), true);
$article_id = $data['article_id'];

// Check if the user has already upvoted the article
$check_vote = $conn->prepare("SELECT * FROM votes WHERE article_id = ? AND user_id = ?");
$check_vote->bind_param("ii", $article_id, $user_id);
$check_vote->execute();
$check_vote->store_result();

if ($check_vote->num_rows > 0) {
    echo json_encode(['status' => 'error', 'message' => 'You have already upvoted this article.']);
} else {
    // Add the upvote
    $vote_stmt = $conn->prepare("INSERT INTO votes (article_id, user_id, vote) VALUES (?, ?, 1)");
    $vote_stmt->bind_param("ii", $article_id, $user_id);

    if ($vote_stmt->execute()) {
        // Increment the likes count in the articles table
        $conn->query("UPDATE articles SET likes = likes + 1 WHERE id = $article_id");
        echo json_encode(['status' => 'success', 'message' => 'Upvote recorded.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to record upvote.']);
    }
}

$check_vote->close();
$vote_stmt->close();
?>
