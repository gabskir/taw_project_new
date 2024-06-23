<?php
include 'config.php';

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
            <input type="text" id="subject" name="subject" required>
            <label for="request">What information would you like to know?</label>
            <textarea id="request" name="request" rows="4" required></textarea>
            <div class="form-footer">
                <p id="formMessage" class="<?php echo isset($_SESSION['form_message']) ? 'visible' : 'hidden'; ?>">
                    <?php echo $_SESSION['form_message'] ?? ''; unset($_SESSION['form_message']); ?>
                </p>
                <input type="submit" value="Submit Request">
            </div>
        </form>
    </section>
</main>
<?php include 'footer.php'; ?>



<script>
document.getElementById('infoRequestForm').addEventListener('submit', function(event) {
    var formMessage = document.getElementById('formMessage');
    if (!formMessage) {
        formMessage = document.createElement('p');
        formMessage.id = 'formMessage';
        formMessage.style.display = 'none';
        this.appendChild(formMessage);
    }
    
    <?php if (!isset($_SESSION['user_id'])): ?>
        event.preventDefault();
        formMessage.style.display = 'block';
        formMessage.innerHTML = 'To request more information, please <a href="login.php">log in</a>.';
    <?php else: ?>
        formMessage.style.display = 'none';
    <?php endif; ?>
});

</script>
