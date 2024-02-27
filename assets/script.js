// Model for requesting a tutor
function openRequestModal(tutorId) {
  var modal = document.getElementById("request-modal");
  if (modal) {
    // Check if the modal exists on the page
    modal.style.display = "block"; // Display the modal
    document.getElementById("tutorId").value = tutorId; // Set the tutorId in the modal form
  }
}

function closeRequestModal() {
  var modal = document.getElementById("request-modal");
  if (modal) {
    // Check if the modal exists on the page
    modal.style.display = "none"; // Hide the modal
  }
}

document.addEventListener("DOMContentLoaded", function () {
  document
    .querySelector("#sessionRequestForm")
    .addEventListener("submit", function (e) {
      e.preventDefault(); // Prevent default form submission

      // Validation for name
      var studentName = this.elements["studentName"].value;
      if (!/^[A-Za-z]+[ ]?[A-Za-z]+$/.test(studentName)) {
        alert(
          "Please enter a valid name with only letters and at most one space."
        );
        return; // Stop the function if validation fails
      }

      // Validation for email
      var studentEmail = this.elements["studentEmail"].value;
      if (!/^\S+@\S+\.\S+$/.test(studentEmail)) {
        alert("Please enter a valid email address.");
        return; // Stop the function if validation fails
      }

      // Proceed with AJAX submission if validation passes

      var formData = new FormData(this);
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "request_session.php", true);
      xhr.onload = function () {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.success) {
            // Hide the form to show only the video call link
            document.querySelector("#sessionRequestForm").style.display =
              "none";
            document.querySelector("#request-modal h2").textContent =
              "Join Session";
            document.querySelector("#request-modal p").textContent =
              "Click the link below to join your call!";
            // Display the video call link in the modal
            var linkContainer = document.getElementById(
              "videoCallLinkContainer"
            );
            linkContainer.innerHTML =
              '<a href="' +
              response.videoCallLink +
              '" target="_blank">Join Video Call</a>';
            linkContainer.style.display = "block"; // Make sure the container is visible
          } else {
            // Handle failure
            document.getElementById("videoCallLinkContainer").textContent =
              "Failed to fetch the video call link. Please try again.";
            document.getElementById("videoCallLinkContainer").style.display =
              "block"; // Show the container with the error message
          }
        } else {
          // Handle HTTP error
          document.getElementById("videoCallLinkContainer").textContent =
            "An error occurred. Please try again.";
          document.getElementById("videoCallLinkContainer").style.display =
            "block"; // Show the container with the error message
        }
      };
      xhr.send(formData);
    });
});

// Slideshow on Index Page Welcome Section
var currentPage = window.location.pathname.split("/").pop() || "index.php";
if (currentPage === "index.php") {
  let slideIndex = 0; // Initialize slide index
  showSlides(); // Start the slideshow

  function showSlides() {
    let slides = document.getElementsByClassName("slide"); // Get all slide elements
    for (let i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {
      slideIndex = 1; // Reset index if it exceeds the number of slides
    }
    slides[slideIndex - 1].style.display = "block";
    setTimeout(showSlides, 3000); // Change image every 3 seconds
  }
}

// Nav bar for mobile - hamburger menu
document.addEventListener("DOMContentLoaded", function () {
  const menuToggle = document.getElementById("mobile-menu");
  const navList = document.querySelector(".nav-list");
  const closeContainer = document.querySelector(".close-container"); // Get the close container

  menuToggle.addEventListener("click", function () {
    navList.classList.toggle("active");
    closeContainer.style.display = "block"; // Show the close button when the menu is active
  });

  closeContainer.addEventListener("click", function (e) {
    e.preventDefault(); // Prevent default anchor behavior
    navList.classList.remove("active");
    this.style.display = "none"; // Hide the close button
  });
});

// Dynamic Password Hint
function showHint() {
  document.getElementById("passwordHint").style.display = "block"; // Show password hint
}
function hideHint() {
  document.getElementById("passwordHint").style.display = "none"; // Hide password hint
}

// UPLOAD PHOTO
document
  .getElementById("upload-photo-button")
  .addEventListener("click", function () {
    var formData = new FormData(document.getElementById("photo-upload-form"));
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update.php", true); // Use your correct path to the upload script
    xhr.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        var response = JSON.parse(this.responseText);
        if (response.success) {
          alert(response.message); // Or update the UI to reflect the uploaded photo
          document.querySelector(".profile-photo-section img").src =
            response.filePath; // Update the image src to the new uploaded photo path
        } else {
          alert(response.message); // Handle upload failure
        }
      }
    };
    xhr.send(formData);
  });

// EDIT BIO
function editBio() {
  var bioEdit = document.getElementById("bio-edit");
  bioEdit.style.display = "block";
  document.getElementById("save-bio").style.display = "block";
  document.getElementById("bio-content").style.display = "none";
  bioEdit.focus();
  bioEdit.setSelectionRange(0, 0);
}

document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("edit-bio").addEventListener("click", editBio);
});

// SAVE BIO
function saveBio() {
  var bioContent = document.getElementById("bio-edit").value; // Get the value from textarea
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "update_bio.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      // Update the bio content div
      document.getElementById("bio-content").innerText = bioContent;
      // Hide the textarea and show the updated bio
      document.getElementById("bio-edit").style.display = "none";
      document.getElementById("save-bio").style.display = "none";
      document.getElementById("bio-content").style.display = "block"; // Make sure this is visible
    }
  };
  xhr.send("bio=" + encodeURIComponent(bioContent));
}

// CHAR COUNT FOR BIO / 300
document.addEventListener("DOMContentLoaded", function () {
  var bioEdit = document.getElementById("bio-edit");
  var charCount = document.getElementById("char-count");

  bioEdit.addEventListener("input", function () {
    var currentLength = bioEdit.value.length;
    charCount.textContent = `${currentLength} / 300`;

    // Change color if over limit
    if (currentLength > 300) {
      charCount.style.color = "red";
    } else {
      charCount.style.color = "black";
    }
  });
});

// GO LIVE BUTTON
document.addEventListener("DOMContentLoaded", function () {
  var goLiveBtn = document.getElementById("go-live-btn");

  goLiveBtn.addEventListener("click", function () {
    var isLive = goLiveBtn.textContent === "Go Live!";

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "toggle_on_call.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status === 200 && xhr.responseText === "success") {
        if (isLive) {
          goLiveBtn.textContent = "Disconnect"; // Change the button text to Disconnect
          goLiveBtn.style.backgroundColor = "red"; // Change the button color to red
        } else {
          goLiveBtn.textContent = "Go Live!"; // Change the button text back to Go Live!
          goLiveBtn.style.backgroundColor = "#0174be"; // Change the button color back to original
        }
      } else {
        // Handle error
        console.log("Error toggling on-call status");
      }
    };
    xhr.send("isLive=" + isLive);
  });
});
