console.log("tes");
const formForgotPassword = document.getElementById("formForgotPassword");

const forgotPasswordEmail = document.getElementById("forgot-password-email");
const forgotPasswordPassword = document.getElementById(
  "forgot-password-password"
);
const forgotPasswordPasswordConfirm = document.getElementById(
  "forgot-password-passwordConfirm"
);

formForgotPassword.addEventListener("submit", function(e) {
  e.preventDefault();
  if (checkForgotPasswordPassword() || checkForgotPasswordPasswordConfirm()) {
    $.ajax({
      type: "POST",
      url: "forgot_password_action.php",
      data: {
        email: forgotPasswordEmail.value,
        password: forgotPasswordPassword.value,
        gantiPassword: true
      },
      success: function(data) {
        const response = JSON.parse(data);
        if (response.success) {
          // window.location.href = "/booking-sunrise/pages/auth/auth.php";
          window.location.href = "/pages/auth/auth.php";
        } else {
          alert(response.message);
        }
      },
      error: function(xhr, ajaxOptions, thrownerror) {}
    });
  }
});

function checkForgotPasswordPassword(params) {
  const forgotPasswordPasswordFeedback = document.getElementById(
    "forgot-password-password-feedback"
  );
  if (forgotPasswordPassword.value === "") {
    forgotPasswordPassword.classList.remove("is-valid");
    forgotPasswordPassword.classList.add("is-invalid");
    forgotPasswordPasswordFeedback.innerHTML = "Password tidak boleh kosong";
    return false;
  } else if (forgotPasswordPassword.value.length < 6) {
    forgotPasswordPassword.classList.remove("is-valid");
    forgotPasswordPassword.classList.add("is-invalid");
    forgotPasswordPasswordFeedback.innerHTML =
      "Password harus minimal 6 karakter";
    return false;
  } else {
    forgotPasswordPassword.classList.remove("is-invalid");
    forgotPasswordPassword.classList.add("is-valid");
    return true;
  }
}

function checkForgotPasswordPasswordConfirm() {
  if (forgotPasswordPasswordConfirm.value === "") {
    forgotPasswordPasswordConfirm.classList.remove("is-valid");
    forgotPasswordPasswordConfirm.classList.add("is-invalid");
    return false;
  } else if (
    forgotPasswordPasswordConfirm.value !== forgotPasswordPassword.value
  ) {
    forgotPasswordPasswordConfirm.classList.remove("is-valid");
    forgotPasswordPasswordConfirm.classList.add("is-invalid");
    return false;
  } else {
    forgotPasswordPasswordConfirm.classList.remove("is-invalid");
    forgotPasswordPasswordConfirm.classList.add("is-valid");
    return true;
  }
}
