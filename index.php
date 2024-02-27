<?php
session_start();
// Load functions and configurations
include 'includes/db.php'; // database connection

?>

<?php include('header.php'); ?>

<main>
<section class="welcome" id="welcome-section">
  <div class="welcome-content">
    <div class="slideshow-container">
      <div class="slide fade">
        <img src="assets/images/welcome_slideshow_1.png" alt="Welcome Image 1">
      </div>
      <div class="slide fade">
        <img src="assets/images/welcome_slideshow_2.png" alt="Welcome Image 2">
      </div>
      <div class="slide fade">
        <img src="assets/images/welcome_slideshow_3.png" alt="Welcome Image 3">
      </div>
    </div>
    <div class="welcome-description">
        <h2>WELCOME!</h2>
        <p>Apollo's On Call Tutoring offers online tutoring for college students across the province.</p>
      </div>
  </div>
</section>

  <h2 id="available-tutors">Available Tutors</h2>
<section class="tutors">
  <?php include('get_tutors_on_call.php'); ?>
</section>

  </main>

  <section class="about-service" id="about">
    <div class="about-feature">
      <img src="assets/images/chat.png" alt="Tailored Lessons Icon">
      <p> Personally tailored lessons from exceptional tutors in an online one-on-one setting.</p>
    </div>
    <div class="about-feature">
      <img src="assets/images/clock.png" alt="Flexible Timing Icon">
      <p>Day, night and weekend appointment options to accommodate your schedule.</p>
    </div>
    <div class="about-feature">
      <img src="assets/images/badge.png" alt="Best Tutors Icon">
      <p>Rigorous interviewing and vetting ensures you receive the best tutor possible.</p>
    </div>
  </section>

  <section class="about" id="about-section">
  <div class="about-content">
    <img src="assets/images/about_image.jpg" alt="About Image">
    <div class="about-description">
      <h3>About Our Service</h3>
      <p>Apollo's On-Call Tutoring Service provides personalized, one-on-one academic support to students in university and college. Our certified tutors are passionate about fostering understanding and confidence, ensuring each student reaches their full potential. Whether it's mastering complex math problems, refining essay-writing skills, or preparing for exams, we tailor our sessions to meet individual needs, ensuring a brighter academic future.</p>
    </div>
  </div>
</section>

<section class="benefits">
  <div class="benefits-section">
    <h3>Online Tutoring with Apollo's On-Call Tutoring</h3>
    <p>At Apollo's On-Call Tutioring, we offer students the highest quality tutoring experience from the GTA to all across Ontario.</p>
    <p>Apollo's On-Call Tutoring supports University and College students with personalized 1-on-1 tutoring in all subjects including Math, Science, English and beyond!</p>

    <h4>Benefits of Online Tutoring</h4>
    <div class="benefit-item">
      <img src="assets/images/tick.png" alt="Checkmark Image">
      <p>Through online tutoring with our professional tutors, certified by the Ontario College of Teachers (OCT), we offer personalized, relationship-driven support to students across Ontario and beyond</p>
    </div>
    <div class="benefit-item">
      <img src="assets/images/tick.png" alt="Checkmark Image">
      <p>Making use of diverse, engaging virtual learning tools, our online tutors offer a practical alternative when traditional in-person tutoring isn't viable or desired. All that's required is a device, reliable internet, and a peaceful setting.</p>
    </div>
    <div class="benefit-item">
      <img src="assets/images/tick.png" alt="Checkmark Image">
      <p>Online tutoring with Apollo's On-Call Tutoring gives students access to the same high calibre tutoring services we are known for in-person, from the comfort and convenience of home, or on the go.</p>
    </div>
  </div>
</section>
<div id="request-modal" class="modal">
  <div class="modal-content">
    <span class="close-button" onclick="closeRequestModal()">&times;</span>
    <h2>Request a Session</h2>
    <p>Enter your name and school email below to request a session with this tutor.</p>
    <form id="sessionRequestForm">
      <label for="studentName">Your Name:</label>
      <input type="text" name="studentName" required>
      <br><br>
      <label for="studentEmail" style="padding-right: 4px;">Your Email:</label>
      <input type="email" name="studentEmail" required>
      <br><br>
      <input type="hidden" name="tutorId" id="tutorId">
      <button type="submit">Submit</button>
    </form>
    <!-- Container for displaying the video call link -->
    <div id="videoCallLinkContainer" style="display:none; margin-top: 20px;">
      <!-- The video call link will be inserted here -->
    </div>
  </div>
</div>


<?php include('footer.php'); ?>
