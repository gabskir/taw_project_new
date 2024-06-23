<?php
include 'config.php';
session_start();

//Send user to a profile page if he is logged in
if (isset($_SESSION['user_id'])){
    header('Location: profile.php');
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
    $role = 'user'; // Default role

    // Check if username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error_message = "Username already exists!";
    } else {
        // Insert new user into database
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $role);
        if ($stmt->execute()) {
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            header('Location: index.php'); // Redirect to user dashboard
            exit();
        } else {
            $error_message = "Error registering user!";
        }
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <a href="index.php" class="back-arrow">&#8592; Back to Homepage</a>
            <h2>Sign Up</h2>
            <p>Already have an account? <a href="login.php">Log In</a></p>
            <?php if (isset($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <form action="register.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <input type="submit" value="SIGN UP">
            </form>
        </div>
        <div class="login-illustration">
            <img src="imgs/Login.png" alt="Sign Up Illustration">
        </div>
    </div>
</body>
</html>
