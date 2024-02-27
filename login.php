<?php
session_start();
include('includes/db.php');

$error = ''; // Variable to hold error message

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Prepare SQL to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, fullname, email, password_hash, profile_photo FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password_hash'])) {
            // Password is correct, create session variables
            $_SESSION['loggedIn'] = true;
            $_SESSION['userId'] = $user['id'];
            $_SESSION['fullName'] = $user['fullname'];
            $_SESSION['profile_photo'] = $user['profile_photo'];

            // Redirect to dashboard or home page
            header("Location: dashboard.php");
            exit;
        } else {
            $error = 'Invalid password.';
        }
    } else {
        $error = 'No user found with that email address.';
    }

    $stmt->close();
}

include('header.php');
?>

<body>
  <?php 
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) { ?>
      <h1>Welcome, <?php echo htmlspecialchars($_SESSION['fullName']); ?>!</h1>
      <a href="index.php?logout=1">Logout</a>
  <?php } else { ?>
      <h2 class="login-header">Welcome! Enter your email and password below to login</h2>
      <?php if (!empty($error)) { ?>
          <p style="color: red;"> <?php echo $error; ?> </p>
      <?php } ?>
      <form method="post" class="login-form">
        <h2 class="header-form">Login</h2>
        <label for="">Email: <br><input type="text" name="email"></label><br>
        <label for="">Password: <input type="password" name="password"></label><br>
        <input type="submit" value="Login">
      </form>
  <?php } ?>
</body>

<?php include('footer.php'); ?>
