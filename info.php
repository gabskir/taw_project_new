<?php
include 'config.php';
session_start();

// Fetch conference details
$conference = $conn->query("SELECT * FROM conference WHERE id = 1")->fetch_assoc();

include 'header.php';
?>
<div class="intro">
    <div class="intro-text">
        <h2>Conference Information</h2>
        <p><?php echo $conference['additional_info']; ?></p>
    </div>
</div>
<main>
    <section class="conference-details">
        <h2>More Information</h2>
        <p>Details about the conference...</p>
    </section>
    
    <section class="info-request">
        <h2>Request More Information</h2>
        <form id="infoRequestForm" action="form_handler.php" method="post">
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject">
            <label for="request">What information would you like to know?</label>
            <textarea id="request" name="request" rows="4"></textarea>
            <input type="submit" value="Submit Request">
        </form>
        <p id="formMessage" style="color: white;"></p>
    </section>
</main>
<script>
    document.getElementById('infoRequestForm').addEventListener('submit', function(event) {
        <?php if (!isset($_SESSION['loggedin'])): ?>
        event.preventDefault();
        document.getElementById('formMessage').innerHTML = 'To request more information, please <a href="login.php">log in</a>.';
        <?php endif; ?>
    });
</script>
<?php include 'footer.php'; ?>
