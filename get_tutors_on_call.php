<?php
include 'includes/db.php';

$query = "SELECT * FROM users WHERE on_call = 1"; 
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while($tutor = $result->fetch_assoc()) {
        echo '<div class="tutor-card">';
        echo '<img src="' . htmlspecialchars($tutor['profile_photo']) . '" alt="Profile photo of ' . htmlspecialchars($tutor['fullname']) . '">';
        echo '<h3>' . htmlspecialchars($tutor['fullname']) . '</h3>';
        echo '<p>' . htmlspecialchars($tutor['bio']) . '</p>';
        echo '<button onclick="openRequestModal(' . htmlspecialchars($tutor['id']) . ')">Request Session</button>';
        echo '</div>';
    }
} else {
    echo 'No tutors available at the moment.';
}

?>
