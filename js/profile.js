const formProfil = document.getElementById("profileForm");
const formPassword = document.getElementById("passwordForm");

const profileFirstName = document.getElementById("profile-firstName");
const profileLastName = document.getElementById("profile-lastName");
const profileEmail = document.getElementById("profile-email");
const profileUsername = document.getElementById("profile-username");
const profileOldPassword = document.getElementById("profile-oldPassword");
const profileNewPassword = document.getElementById("profile-newPassword");
const profileConfirmNewPassword = document.getElementById(
  "profile-confirmPassword"
);

formProfil.addEventListener("submit", function(e) {
  e.preventDefault();
  if (
    checkUpdateFirstName() &&
    checkUpdateLastName() &&
    checkUpdateUsername() &&
    checkUpdateEmail()
  ) {
    $.ajax({
      type: "POST",
      url: "profile_action.php",
      data: {
        first_name: profileFirstName.value,
        last_name: profileLastName.value,
        email: profileEmail.value,
        username: profileUsername.value
      },
      success: function(data) {
        let response = JSON.parse(data);
        if (response.success === "success") {
          window.location.href = "profile.php";
        } else {
          window.location.href =
            "profile.php?success-profile=false&message=" + response.message;
        }
      },
      error: function(xhr, ajaxOptions, thrownerror) {}
    });
  }
});

formPassword.addEventListener("submit", function(e) {
  e.preventDefault();
  if (checkUpdateNewPassword() && checkUpdateNewPasswordConfirm()) {
    $.ajax({
      type: "POST",
      url: "profile_action.php",
      data: {
        old_password: profileOldPassword.value,
        new_password: profileNewPassword.value,
        update_password: true
      },
      success: function(data) {
        let response = JSON.parse(data);
        if (response.success === "success") {
          window.location.href = "profile.php";
        } else {
          window.location.href =
            "profile.php?success-password=false&message=" + response.message;
        }
      },
      error: function(xhr, ajaxOptions, thrownerror) {}
    });
  }
});

(function($) {
  $("#sidebarCollapse").on("click", function() {
    $("#sidebar").toggleClass("active");
  });
})(jQuery);

function displayFormProfile() {
  var profile = document.getElementById("profile");
  var profileForm = document.getElementById("profileForm");
  if (
    profile.style.display === "block" ||
    profileForm.style.display === "none"
  ) {
    profile.style.display = "none";
    profileForm.style.display = "block";
  } else {
    profileForm.style.display = "none";
    profile.style.display = "block";
  }
}

function displayFormChangePw() {
  var passwordForm = document.getElementById("passwordForm");
  if (passwordForm.style.display === "none") {
    passwordForm.style.display = "block";
  } else {
    passwordForm.style.display = "none";
  }
}

function profileForm() {}

function checkUpdateFirstName() {
  if (profileFirstName.value === "") {
    profileFirstName.classList.remove("is-valid");
    profileFirstName.classList.add("is-invalid");
    return false;
  } else {
    profileFirstName.classList.remove("is-invalid");
    profileFirstName.classList.add("is-valid");
    return true;
  }
}

function checkUpdateLastName() {
  if (profileLastName.value === "") {
    profileLastName.classList.remove("is-valid");
    profileLastName.classList.add("is-invalid");
    return false;
  } else {
    profileLastName.classList.remove("is-invalid");
    profileLastName.classList.add("is-valid");
    return true;
  }
}

function checkUpdateUsername() {
  const profileUsernameFeedback = document.getElementById(
    "profile-username-feedback"
  );
  if (profileUsername.value === "") {
    profileUsername.classList.remove("is-valid");
    profileUsername.classList.add("is-invalid");
    profileUsernameFeedback.innerHTML = "Username tidak boleh kosong";
    return false;
  } else if (
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
      profileUsername.value
    )
  ) {
    profileUsername.classList.remove("is-valid");
    profileUsername.classList.add("is-invalid");
    profileUsernameFeedback.innerHTML = "Format username tidak boleh email";
    return false;
  } else {
    profileUsername.classList.remove("is-invalid");
    profileUsername.classList.add("is-valid");
    return true;
  }
}

function checkUpdateEmail() {
  const profileEmailFeedback = document.getElementById(
    "profile-email-feedback"
  );
  if (profileEmail.value === "") {
    profileEmail.classList.remove("is-valid");
    profileEmail.classList.add("is-invalid");
    profileEmailFeedback.innerHTML = "Email tidak boleh kosong";
    return false;
  } else if (
    !/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
      profileEmail.value
    )
  ) {
    profileEmail.classList.remove("is-valid");
    profileEmail.classList.add("is-invalid");
    profileEmailFeedback.innerHTML = "Format email harus benar";
    return false;
  } else {
    profileEmail.classList.remove("is-invalid");
    profileEmail.classList.add("is-valid");
    return true;
  }
}

function checkUpdateNewPassword() {
  const profileNewPasswordFeedback = document.getElementById(
    "profile-newPassword-feedback"
  );
  if (profileNewPassword.value === "") {
    profileNewPassword.classList.remove("is-valid");
    profileNewPassword.classList.add("is-invalid");
    profileNewPasswordFeedback.innerHTML = "Password tidak boleh kosong";
    return false;
  } else if (profileNewPassword.value.length < 6) {
    profileNewPassword.classList.remove("is-valid");
    profileNewPassword.classList.add("is-invalid");
    profileNewPasswordFeedback.innerHTML = "Password harus minimal 6 karakter";
    return false;
  } else {
    profileNewPassword.classList.remove("is-invalid");
    profileNewPassword.classList.add("is-valid");
    return true;
  }
}

function checkUpdateNewPasswordConfirm() {
  if (profileConfirmNewPassword.value === "") {
    profileConfirmNewPassword.classList.remove("is-valid");
    profileConfirmNewPassword.classList.add("is-invalid");
    return false;
  } else if (profileConfirmNewPassword.value !== profileNewPassword.value) {
    profileConfirmNewPassword.classList.remove("is-valid");
    profileConfirmNewPassword.classList.add("is-invalid");
    return false;
  } else {
    profileConfirmNewPassword.classList.remove("is-invalid");
    profileConfirmNewPassword.classList.add("is-valid");
    return true;
  }
}
