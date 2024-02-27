<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apollo's On-Call Tutoring</title>
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

<header>
  <h1>Apollo's On-Call Tutoring</h1>
  <nav class="nav-menu">
  <button class="menu-toggle" id="mobile-menu">
    <span class="bar"></span>
    <span class="bar"></span>
    <span class="bar"></span>
  </button>
  <ul class="nav-list">
    <li class="close-container"><a href="#" id="close-menu">X</a></li>
    <li><a href="index.php">Home</a></li>
    <li><a href="index.php#about">About</a></li>
    <li><a href="index.php#available-tutors">Available Tutors</a></li>
      <?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']): ?>
    <!-- Display when user is logged in -->
    <li><a href="dashboard.php">Dashboard</a></li>
    <!-- Logout Link -->
    <li>
      <a href="logout.php" class="logout-link">Logout</a>
    </li>

  <?php else: ?>
    <!-- Display when no user is logged in -->
    <li><a href="register.php">Register as Tutor</a></li>
    <li><a href="login.php">Tutor Login</a></li>
  <?php endif; ?>
  </ul>
</nav>

</header>