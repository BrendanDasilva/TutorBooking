<?php
session_start();
include('includes/db.php');

if(isset($_SESSION['userId']) && !empty($_POST['bio'])) {
    // Strip tags and enforce a maximum length of 300 characters
    $newBio = substr(strip_tags(trim($_POST['bio'])), 0, 300);
    $userId = $_SESSION['userId'];

    $stmt = $conn->prepare("UPDATE users SET bio = ? WHERE id = ?");
    $stmt->bind_param("si", $newBio, $userId);
    if($stmt->execute()) {
        echo "Bio updated successfully.";
    } else {
        echo "Error updating bio.";
    }
    $stmt->close();
} else {
    echo "No bio content received.";
}
$conn->close();

?>