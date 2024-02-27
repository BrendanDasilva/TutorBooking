<?php include('header.php'); ?>

<main>
  <h1>Tutor Registration Form</h1>
  <p>Fill out the form below to register</p>
  <div class="registration-form">
  <form action="process_registration.php" method="post">
    <h2>Registration Form:</h2>
    <label for="fullname">Full Name:</label>
    <input type="text" id="fullname" name="fullname" pattern="[A-Za-z ]{1,25}" title="Name should only contain letters and be up to 25 characters long" required>

    <br><br>

    <label for="email">Email Address:</label>
    <input type="email" id="email" name="email" required>
    <br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" onfocus="showHint()" onblur="hideHint()" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}" title="Password must be 6-20 characters long, include at least one number and one uppercase letter" required>
    <div id="passwordHint" style="display:none;color:grey;">Password must be between 6 - 20 characters and have at least one number and one capital letter.</div>
    <br><br>

    <input type="submit" value="Register">
  </form>
</div>
</main>

<?php include('footer.php'); ?>