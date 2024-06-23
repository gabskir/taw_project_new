<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = trim($_POST['subject']);
    $request = trim($_POST['request']);
    $user_id = $_SESSION['user_id'];

    if (empty($subject) || empty($request)) {
        $_SESSION['form_message'] = "Both subject and request fields are required.";
        header('Location: info.php');
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO requests (subject, request, user_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $subject, $request, $user_id);

    if ($stmt->execute()) {
        $_SESSION['form_message'] = "Your request has been sent.";
        header('Location: info.php');
    } else {
        $_SESSION['form_message'] = "Failed to submit your request.";
        header('Location: info.php');
    }

    $stmt->close();
    exit();
}
?>
