<?php
include 'config.php';
session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <a href="index.php" class="back-arrow">&#8592; Back to Homepage</a>
            <h2>Your Account</h2>
            <?php if (isset($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <form action="logout.php" method="post">
                <label for="username">Name: <?php echo htmlspecialchars($_SESSION['username'])?></label>
                <?php if($_SESSION['role'] == 'admin'):?>
                    <label for="role">Role: General Administrator</label>
                    <a href="admin_dashboard.php">Access Admin Dashboard</a>
                <?php elseif($_SESSION['role'] == 'trackadmin'):?> 
                    <label for="role">Role: Tracks Administrator</label>
                <?php else:?>
                    <label for="role">Role: Visitor</label> 
                <?php endif?> 
                <p>Do you want to log out?</p>                
                <input type="submit" value="LOG OUT">
            </form>
        </div>
        <div class="login-illustration">
            <img src="imgs/Login.png" alt="Login Illustration">
        </div>
    </div>
</body>
</html>
