<?php
session_start();
include('includes/db.php'); 

// Function to sanitize data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = sanitize_input($_POST['fullname']);
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password'];

    // Validate input and check if email already exists in the database
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Email already registered
        echo "This email is already registered. Please use a different email.";
    } else {
        // Email is unique, proceed with registration
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        
        // Prepare an insert statement
        $stmt = $conn->prepare("INSERT INTO users (fullname, email, password_hash) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $fullname, $email, $hashed_password);
        
        if ($stmt->execute()) {
            // Registration successful
            echo "Registration successful. You can now login.";
            // Redirect to login page or dashboard
            header("Location: thank_you.php");
        } else {
            // Registration failed
            echo "Error: " . $stmt->error;
        }
    }
    $stmt->close();
}

$conn->close();
?>
