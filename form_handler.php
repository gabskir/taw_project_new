<?php
include 'config.php';
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['id'];
    $subject = $conn->real_escape_string($_POST['subject']);
    $request = $conn->real_escape_string($_POST['request']);

    $sql = "INSERT INTO requests (user_id, subject, request) VALUES ('$user_id', '$subject', '$request')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['form_message'] = "Request submitted successfully!";
    } else {
        $_SESSION['form_message'] = "Error: " . $sql . "<br>" . $conn->error;
    }
    header('Location: info.php');
}
?>
