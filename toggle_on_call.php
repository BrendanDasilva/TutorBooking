<?php
session_start();
include('includes/db.php');

if(isset($_SESSION['userId']) && isset($_POST['isLive'])) {
    $userId = $_SESSION['userId'];
    $isLive = $_POST['isLive'] === 'true' ? 1 : 0;
    
    $stmt = $conn->prepare("UPDATE users SET on_call = ? WHERE id = ?");
    $stmt->bind_param("ii", $isLive, $userId);
    
    if($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
    $stmt->close();
} else {
    echo "error";
}
$conn->close();
?>
