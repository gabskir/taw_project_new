<?php
include 'config.php';

// Fetch conference details
$conference = $conn->query("SELECT * FROM conference WHERE id = 1")->fetch_assoc();

include 'header.php';
?>
<div class="intro">
    <div class="intro-text">
        <h2>Location</h2>
        <p>The <?php echo $conference['name']; ?> will be held in <?php echo $conference['location']; ?> from <?php echo $conference['start_date']; ?> to <?php echo $conference['end_date']; ?>. Join us at this prestigious venue to explore the latest innovations in machine learning.</p>
    </div>
    <div class="intro-image blend-image-container">
        <img src="<?php echo $conference['image_url']; ?>" alt="Location Image">
    </div>
</div>
<main>
    <section class="venue-details">
        <h2>Venue Details</h2>
        <p><strong><?php echo $conference['venue_name']; ?></strong></p>
        <p><?php echo $conference['venue_description']; ?></p>
        <p><?php echo $conference['venue_contact']; ?></p>
        <p><strong>Address:</strong> <?php echo $conference['full_address']; ?></p>
    </section>
</main>
<?php include 'footer.php'; ?>
