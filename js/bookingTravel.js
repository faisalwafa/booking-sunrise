const bookingTravelFirstName = document.getElementById(
  "travelBooking-firstName"
);
const bookingTravelLastName = document.getElementById("travelBooking-lastName");
const bookingTravelEmail = document.getElementById("travelBooking-email");
const bookingTravelEmailVerify = document.getElementById(
  "travelBooking-emailVerify"
);
const bookingTravelPax = document.getElementById("travelBooking-pax");
const bookingTravelPhone = document.getElementById("travelBooking-phoneNumber");
const bookingTravelDate = document.getElementById("travelBooking-date");
const bookingTravelTime = document.getElementById("travelBooking-time");
const bookingTravelLocation = document.getElementById("travelBooking-location");
const bookingTravelCountry = document.getElementById("travelBooking-country");
const bookingTravelReq = document.getElementById("travelBooking-specialReq");
const formTravelBooking = document.getElementById("travelBookingForm");

function getParameterByName(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}

// formTravelBooking.addEventListener("submit", function(e)) {
//     e.preventDefault();
//     if (
//         checkBookingTravelFirstName() &&
//         checkBookingTravelLastName() &&
//         checkBookingTravelEmail() &&
//         checkBookingTravelConfirmEmail() &&
//         checkBookingTravelLocation() &&
//         checkBookingTravelPhoneNumber()
//     ) {
//         $.ajax({
//             type: "POST",
//             url: ""
//         })
//     }
// }

function checkBookingTravelFirstName() {
  if (bookingTravelFirstName.value === "") {
    bookingTravelFirstName.classList.remove("is-valid");
    bookingTravelFirstName.classList.add("is-invalid");
    return false;
  } else {
    bookingTravelFirstName.classList.remove("is-invalid");
    bookingTravelFirstName.classList.add("is-valid");
    return true;
  }
}

function checkBookingTravelLastName() {
  if (bookingTravelLastName.value === "") {
    bookingTravelLastName.classList.remove("is-valid");
    bookingTravelLastName.classList.add("is-invalid");
    return false;
  } else {
    bookingTravelLastName.classList.remove("is-invalid");
    bookingTravelLastName.classList.add("is-valid");
    return true;
  }
}

function checkBookingTravelEmail() {
  const bookingTravelEmailFeedback = document.getElementById(
    "bookingTravel-email-feedback"
  );
  if (bookingTravelEmail.value === "") {
    bookingTravelEmail.classList.remove("is-valid");
    bookingTravelEmail.classList.add("is-invalid");
    bookingTravelEmailFeedback.innerHTML = "Email tidak boleh kosong";
    return false;
  } else if (
    !/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
      bookingTravelEmail.value
    )
  ) {
    bookingTravelEmail.classList.remove("is-valid");
    bookingTravelEmail.classList.add("is-invalid");
    bookingTravelEmailFeedback.innerHTML = "Format email harus benar";
    return false;
  } else {
    bookingTravelEmail.classList.remove("is-invalid");
    bookingTravelEmail.classList.add("is-valid");
    return true;
  }
}

function checkBookingTravelConfirmEmail() {
  const bookingTravelVerifyEmailFeedback = document.getElementById(
    "bookingTravel-confirmEmail-feedback"
  );

  if (bookingTravelEmailVerify.value === "") {
    bookingTravelEmailVerify.classList.remove("is-valid");
    bookingTravelEmailVerify.classList.add("is-invalid");
    bookingTravelVerifyEmailFeedback.innerHTML = "Email tidak boleh kosong";
    return false;
  } else if (
    !/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
      bookingTravelEmailVerify.value
    )
  ) {
    bookingTravelEmailVerify.classList.remove("is-valid");
    bookingTravelEmailVerify.classList.add("is-invalid");
    bookingTravelVerifyEmailFeedback.innerHTML = "Format email harus benar";
    return false;
  } else if (bookingTravelEmailVerify.value != bookingTravelEmail.value) {
    bookingTravelEmailVerify.classList.remove("is-valid");
    bookingTravelEmailVerify.classList.add("is-invalid");
    bookingTravelVerifyEmailFeedback.innerHTML = "Email tidak cocok";
    return false;
  } else {
    bookingTravelEmailVerify.classList.remove("is-invalid");
    bookingTravelEmailVerify.classList.add("is-valid");
    return true;
  }
}

function checkBookingTravelPax() {
  if (bookingTravelPax.value === "") {
    bookingTravelPax.classList.remove("is-valid");
    bookingTravelPax.classList.add("is-invalid");
    return false;
  } else {
    bookingTravelPax.classList.remove("is-invalid");
    bookingTravelPax.classList.add("is-valid");
    return true;
  }
}

function checkBookingTravelPhoneNumber() {
  if (bookingTravelPhone.value === "") {
    bookingTravelPhone.classList.remove("is-valid");
    bookingTravelPhone.classList.add("is-invalid");
    return false;
  } else {
    bookingTravelPhone.classList.remove("is-invalid");
    bookingTravelPhone.classList.add("is-valid");
    return true;
  }
}

function checkBookingTravelLocation() {
  if (bookingTravelLocation.value === "") {
    bookingTravelLocation.classList.remove("is-valid");
    bookingTravelLocation.classList.add("is-invalid");
    return false;
  } else {
    bookingTravelLocation.classList.remove("is-invalid");
    bookingTravelLocation.classList.add("is-valid");
    return true;
  }
}
