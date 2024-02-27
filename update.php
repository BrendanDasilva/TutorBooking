<?php
session_start();
header('Content-Type: application/json'); // Indicate the response type
include('includes/db.php');

// Check if the user is logged in and a file has been uploaded
if (!isset($_SESSION['userId']) || !isset($_FILES['profilePhoto'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to upload a photo.']);
    exit;
}

$userId = $_SESSION['userId'];
$uploadDir = 'data/uploads/';
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
$maxFileSize = 8 * 1024 * 1024; // 8MB

// Validate the uploaded file
if (in_array($_FILES['profilePhoto']['type'], $allowedTypes) && $_FILES['profilePhoto']['size'] <= $maxFileSize) {
    $fileExt = pathinfo($_FILES['profilePhoto']['name'], PATHINFO_EXTENSION);
    // Ensure the filename is within the maximum length
    $newFileName = substr(md5(uniqid(rand(), true)), 0, 15) . '.' . $fileExt; // Create a new filename
    $newFilePath = $uploadDir . $newFileName;

    // Move the uploaded file to the uploads directory
    if (move_uploaded_file($_FILES['profilePhoto']['tmp_name'], $newFilePath)) {
        // Update the database with the new file path
        $stmt = $conn->prepare("UPDATE users SET profile_photo = ? WHERE id = ?");
        $stmt->bind_param("si", $newFilePath, $userId);
        if ($stmt->execute()) {
            $_SESSION['profile_photo'] = $newFilePath; // Update the session variable
            echo json_encode(['success' => true, 'message' => 'Photo uploaded successfully.', 'filePath' => $newFilePath]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update the database.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to move the uploaded file.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid file type or size too large.']);
}
$conn->close();
?>
