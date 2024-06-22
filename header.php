<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($conference['name']) ? $conference['name'] : 'Conference'; ?></title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <header class="main-header">
        <div class="header-content">
            <div class="logo">
                <h1><?php echo isset($conference['name']) ? $conference['name'] : 'Conference'; ?></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="location.php">Location</a></li>
                    <li><a href="info.php">Information</a></li>
                    <li><a href="articles.php">Articles</a></li>
                    <li><a href="schedule.php">Schedule</a></li>
                    <li><a href="tracks.php">Tracks</a></li>
                </ul>
                <div class="account-icon">
                    <a href="login.php"><img src="imgs/account-icon.png" alt="Account"></a>
                </div>
            </nav>
        </div>
    </header>
