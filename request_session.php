<?php
include 'includes/db.php'; // Make sure the path is correct

$response = ['success' => false];

if (isset($_POST['studentName'], $_POST['studentEmail'], $_POST['tutorId'])) {
    $tutorId = $_POST['tutorId'];
    // Optionally validate studentName and studentEmail here

    // Fetch the tutor's video call link from the database
    $stmt = $conn->prepare("SELECT video_call_link FROM users WHERE id = ?");
    $stmt->bind_param("i", $tutorId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $response = ['success' => true, 'videoCallLink' => $row['video_call_link']];
    } else {
        $response['message'] = 'Tutor not found or no video call link available.';
    }
    $stmt->close();
} else {
    $response['message'] = 'Missing information.';
}

echo json_encode($response);
?>
