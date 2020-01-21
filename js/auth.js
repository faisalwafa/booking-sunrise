const formRegister = document.getElementById("formRegister");
const formLogin = document.getElementById("formLogin");

const registerFirstName = document.getElementById("register-firstName");
const registerLastName = document.getElementById("register-lastName");
const registerUsername = document.getElementById("register-username");
const registerEmail = document.getElementById("register-email");
const registerPassword = document.getElementById("register-password");
const registerPasswordConfirm = document.getElementById(
  "register-passwordConfirm"
);

const loginUsername = document.getElementById("login-username");
const loginPassword = document.getElementById("login-password");

const tabPillsDaftar = document.getElementById("pills-daftar-tab");
const tabPillsMasuk = document.getElementById("pills-masuk-tab");

const pillsDaftar = document.getElementById("pills-daftar");
const pillsMasuk = document.getElementById("pills-masuk");

function getParameterByName(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}

formRegister.addEventListener("submit", function(e) {
  e.preventDefault();
  if (
    checkRegisterFirstName() ||
    checkRegisterLastName() ||
    checkRegisterEmail() ||
    checkRegisterUsername() ||
    checkRegisterPassword() ||
    checkRegisterPasswordConfirm()
  ) {
    $.ajax({
      type: "POST",
      url: "auth_action.php",
      data: {
        first_name: registerFirstName.value,
        last_name: registerLastName.value,
        email: registerEmail.value,
        username: registerUsername.value,
        password: registerPassword.value
      },
      success: function(data) {
        let response = JSON.parse(data);
        if (response.success === "success") {
          document.getElementById("alert-login").style.display = "block";

          tabPillsDaftar.classList.remove("active");
          tabPillsDaftar.getAttribute("aria-selected", "false");
          tabPillsMasuk.classList.add("active");
          tabPillsMasuk.getAttribute("aria-selected", "true");

          pillsDaftar.classList.remove("show");
          pillsDaftar.classList.remove("active");
          pillsMasuk.classList.add("active", "show");
        } else {
          document.getElementById("alert-failed-daftar").style.display =
            "block";
          document.getElementById("daftar-failed-feedback").innerHTML =
            response.message;
        }
        // window.location.href = 'addcust.php?new_sale=' + data
      },
      error: function(xhr, ajaxOptions, thrownerror) {}
    });
  }
});

formLogin.addEventListener("submit", function(e) {
  e.preventDefault();
  if (checkLoginUsername() || checkLoginPassword()) {
    $.ajax({
      type: "POST",
      url: "auth_action.php",
      data: {
        login: "true",
        username: loginUsername.value,
        password: loginPassword.value
      },
      success: function(data) {
        let response = JSON.parse(data);
        console.log(response);
        if (response.success === "success") {
          const tour = getParameterByName("tour");
          if (tour) {
            window.location.href =
              "/booking-sunrise/pages/tour/tour.php?tour=" + tour;
          } else {
            window.location.href = "http://sunrise-indonesia.com";
          }
        } else {
          document.getElementById("alert-failed-login").style.display = "block";
          document.getElementById("login-failed-feedback").innerHTML =
            response.message;
        }
      },
      error: function(xhr, ajaxOptions, thrownerror) {}
    });
  }
});

function checkRegisterFirstName() {
  if (registerFirstName.value === "") {
    registerFirstName.classList.remove("is-valid");
    registerFirstName.classList.add("is-invalid");
    return false;
  } else {
    registerFirstName.classList.remove("is-invalid");
    registerFirstName.classList.add("is-valid");
    return true;
  }
}

function checkRegisterLastName() {
  if (registerLastName.value === "") {
    registerLastName.classList.remove("is-valid");
    registerLastName.classList.add("is-invalid");
    return false;
  } else {
    registerLastName.classList.remove("is-invalid");
    registerLastName.classList.add("is-valid");
    return true;
  }
}

function checkRegisterUsername() {
  const registerUsernameFeedback = document.getElementById(
    "register-username-feedback"
  );
  if (registerUsername.value === "") {
    registerUsername.classList.remove("is-valid");
    registerUsername.classList.add("is-invalid");
    registerUsernameFeedback.innerHTML = "Username tidak boleh kosong";
    return false;
  } else if (
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
      registerUsername.value
    )
  ) {
    registerUsername.classList.remove("is-valid");
    registerUsername.classList.add("is-invalid");
    registerUsernameFeedback.innerHTML = "Format username tidak boleh email";
    return false;
  } else {
    registerUsername.classList.remove("is-invalid");
    registerUsername.classList.add("is-valid");
    return true;
  }
}

function checkRegisterEmail() {
  const registerEmailFeedback = document.getElementById(
    "register-email-feedback"
  );
  if (registerEmail.value === "") {
    registerEmail.classList.remove("is-valid");
    registerEmail.classList.add("is-invalid");
    registerEmailFeedback.innerHTML = "Email tidak boleh kosong";
    return false;
  } else if (
    !/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
      registerEmail.value
    )
  ) {
    registerEmail.classList.remove("is-valid");
    registerEmail.classList.add("is-invalid");
    registerEmailFeedback.innerHTML = "Format email harus benar";
    return false;
  } else {
    registerEmail.classList.remove("is-invalid");
    registerEmail.classList.add("is-valid");
    return true;
  }
}

function checkRegisterPassword() {
  const registerPasswordFeedback = document.getElementById(
    "register-password-feedback"
  );
  if (registerPassword.value === "") {
    registerPassword.classList.remove("is-valid");
    registerPassword.classList.add("is-invalid");
    registerPasswordFeedback.innerHTML = "Password tidak boleh kosong";
    return false;
  } else if (registerPassword.value.length < 6) {
    registerPassword.classList.remove("is-valid");
    registerPassword.classList.add("is-invalid");
    registerPasswordFeedback.innerHTML = "Password harus minimal 6 karakter";
    return false;
  } else {
    registerPassword.classList.remove("is-invalid");
    registerPassword.classList.add("is-valid");
    return true;
  }
}

function checkRegisterPasswordConfirm() {
  if (registerPasswordConfirm.value === "") {
    registerPasswordConfirm.classList.remove("is-valid");
    registerPasswordConfirm.classList.add("is-invalid");
    return false;
  } else if (registerPasswordConfirm.value !== registerPassword.value) {
    registerPasswordConfirm.classList.remove("is-valid");
    registerPasswordConfirm.classList.add("is-invalid");
    return false;
  } else {
    registerPasswordConfirm.classList.remove("is-invalid");
    registerPasswordConfirm.classList.add("is-valid");
    return true;
  }
}

function checkLoginUsername() {
  if (loginUsername.value === "") {
    loginUsername.classList.remove("is-valid");
    loginUsername.classList.add("is-invalid");
    return false;
  } else {
    loginUsername.classList.remove("is-invalid");
    loginUsername.classList.add("is-valid");
    return true;
  }
}

function checkLoginPassword() {
  if (loginPassword.value === "") {
    loginPassword.classList.remove("is-valid");
    loginPassword.classList.add("is-invalid");
    return false;
  } else {
    loginPassword.classList.remove("is-invalid");
    loginPassword.classList.add("is-valid");
    return true;
  }
}
