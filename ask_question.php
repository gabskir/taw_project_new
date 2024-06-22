<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $article_id = $_POST['article_id'];
    $question = $_POST['question'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO questions (article_id, question, user_id) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $article_id, $question, $user_id);

    if ($stmt->execute()) {
        header('Location: article_detail.php?id=' . $article_id);
    } else {
        echo "Failed to submit your question.";
    }

    $stmt->close();
}
?>
