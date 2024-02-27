<?php
session_start();

// Redirect user to login page if not logged in.
if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
  header('Location: login.php');
  exit;
}
include('includes/db.php');
include('header.php'); ?>

<main>
  <h1>Dashboard</h1>
  <h2>Welcome, <?php echo htmlspecialchars($_SESSION['fullName']); ?>!</h2>
  <p class="bio-instruction">Here in the dashboard you can upload a profile photo and write a mini-description (300 character max) introducing yourself and what you specialize in. At the bottom we have included a Video Call Link box. Once you are ready to set your availability to on-call, paste your link in the box and hit the Go Live! button.</p>

  <div class="profile-container">
    <form id="photo-upload-form" action="upload.php" method="post" enctype="multipart/form-data">
      <div class="profile-photo-section">
        <!-- Checks if a session variable for 'profile_photo' is set, -->
        <!-- if it is, it will display the uploaded photo, otherwise, it will show the default photo. -->
        <?php if (!empty($_SESSION['profile_photo'])): ?>
          <img src="<?php echo htmlspecialchars($_SESSION['profile_photo']); ?>" alt="Profile Photo">
        <?php else: ?>
          <img src="data/uploads/default-profile.png" alt="Profile Photo">
        <?php endif; ?>

        <br>
  
        <label for="profile-photo-upload">Upload Photo</label>
        <input type="file" id="profile-photo-upload" name="profilePhoto" accept=".jpg, .jpeg, .png, .gif">
        <button type="button" id="upload-photo-button">Upload Photo</button>
      </div>
    </form>

    <?php
    $bioContent = ''; // Default value if no bio is set
    if (isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
        $stmt = $conn->prepare("SELECT bio FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $bioContent = $row['bio'];
        }
        $stmt->close();
    }
    ?>

    <div class="bio-section">
      <strong>Bio: </strong><button id="edit-bio">Edit</button>
      <div id="bio-content">
        <!-- The bio will be loaded here -->
        <?php echo htmlspecialchars($bioContent); ?>
      </div>
      <textarea id="bio-edit" maxlength="300" style="display: none;"></textarea>
        <!-- Character counter display -->
        <div id="char-count">0 / 300</div>
      <button id="save-bio" style="display: none;" onclick="saveBio()">Save</button>
    </div>
  </div>

  <div class="video-call-link">
    <label for="video-call-input"><strong>Video Call Link:</strong></label>
    <input type="text" id="video-call-input" placeholder="Paste your video call link here">
    <button type="button" id="go-live-btn">Go Live!</button>
  </div>
  <form method="get" action="logout.php" class="logout">
    <input type="hidden" name="logout" value="1">
    <input type="submit" value="Logout">
  </form>

</main>

<?php include('footer.php'); ?>
