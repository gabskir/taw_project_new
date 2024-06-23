<?php
include 'config.php';

// Fetch conference details
$conference = $conn->query("SELECT * FROM conference WHERE id = 1")->fetch_assoc();

include 'header.php';

// Fetch schedule data
$schedule_query = "SELECT s.*, a.title AS article_title, a.authors, t.name AS track_name
                   FROM schedule s
                   JOIN articles a ON s.article_id = a.id
                   JOIN tracks t ON s.track_id = t.id
                   ORDER BY s.day, s.time, s.room";
$schedule_result = $conn->query($schedule_query);

$schedule_data = [];
while ($row = $schedule_result->fetch_assoc()) {
    $day = $row['day'];
    $room = $row['room'];
    if (!isset($schedule_data[$day])) {
        $schedule_data[$day] = [];
    }
    if (!isset($schedule_data[$day][$room])) {
        $schedule_data[$day][$room] = [];
    }
    $schedule_data[$day][$room][] = $row;
}
?>

<div class="intro">
    <div class="intro-text">
        <h2>Schedule</h2>
        <p>The <?php echo $conference['name']; ?> will take place from <?php echo date('F j, Y', strtotime($conference['start_date'])); ?> to <?php echo date('F j, Y', strtotime($conference['end_date'])); ?> in <?php echo $conference['location']; ?>.</p>
    </div>
</div>
<main>
    <div class="schedule-container">
        <?php foreach ($schedule_data as $day => $rooms): ?>
            <section class="schedule-day">
                <h3><?php echo date('l, F j, Y', strtotime($day)); ?></h3>
                <?php foreach ($rooms as $room => $sessions): ?>
                    <div class="schedule-room">
                        <h4>Room <?php echo $room; ?></h4>
                        <?php foreach ($sessions as $session): ?>
                            <div class="schedule-session">
                                <p><strong><?php echo date('H:i', strtotime($session['time'])); ?> - <?php echo $session['article_title']; ?></strong></p>
                                <p>Track: <?php echo $session['track_name']; ?></p>
                                <p>Authors: <?php echo $session['authors']; ?></p>
                                <p><a href="article_detail.php?id=<?php echo $session['article_id']; ?>">View Article</a></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </section>
        <?php endforeach; ?>
    </div>
</main>
<?php include 'footer.php'; ?>
