<?php
require "db.php";

$marathon_id = 1; // demo
$result = mysqli_query($conn,
    "SELECT * FROM checkpoints WHERE marathon_id=$marathon_id"
);
?>

<h2>Marathon Checkpoints Gallery</h2>

<?php while ($c = mysqli_fetch_assoc($result)) { ?>
    <div style="margin-bottom:20px;">
        <p><?= htmlspecialchars($c['description']) ?></p>
        <img src="<?= htmlspecialchars($c['image_path']) ?>" width="250">
    </div>
<?php } ?>

<a href="dashboard.php">Back</a>
