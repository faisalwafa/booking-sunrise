const bookingFirstName = document.getElementById("booking-firstName");
const bookingLastName = document.getElementById("booking-lastName");
const bookingEmail = document.getElementById("booking-email");
const bookingVerifyEmail = document.getElementById("booking-verifyEmail");
const bookingPhoneNumber = document.getElementById("booking-phoneNumber");
const bookingZipCode = document.getElementById("booking-zipCode");
const bookingAddress = document.getElementById("booking-address");
const bookingCity = document.getElementById("booking-city");
const bookingSpecialReq = document.getElementById("booking-specialReq");
const formBooking = document.getElementById("bookingForm");

function getParameterByName(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}

formBooking.addEventListener("submit", function(e) {
  e.preventDefault();
  if (
    checkBookingFirstName() &&
    checkBookingLastName() &&
    checkBookingEmail() &&
    checkBookingConfirmEmail() &&
    checkBookingPhoneNumber() &&
    checkBookingAddress() &&
    checkBookingCity() &&
    checkBookingZipCode()
  ) {
    $.ajax({
      type: "POST",
      url: "booking_action.php",
      data: {
        firstName: bookingFirstName.value,
        lastName: bookingLastName.value,
        email: bookingEmail.value,
        confirmEmail: bookingVerifyEmail.value,
        countryCode: bookingPhoneNumber.value,
        phoneNumber: bookingZipCode.value,
        address: bookingAddress.value,
        city: bookingCity.value,
        zipCode: bookingZipCode.value,
        specialReq: bookingSpecialReq.value,
        tour: getParameterByName("tour"),
        stId: getParameterByName("st_id"),
        tourDate: getParameterByName("dateTour"),
        totalAdults: getParameterByName("totalAdults"),
        totalPrice: getParameterByName("totalPrice"),
        postTitle: getParameterByName("post_title"),
        location: getParameterByName("location"),
        duration: getParameterByName("duration"),
        price: getParameterByName("price"),
        gRecaptchaResponse: grecaptcha.getResponse()
      },
      success: function(data) {
        const response = JSON.parse(data);
        const responseData = JSON.parse(response.message);
        if (response.success === "success") {
          window.location.href =
            "../booking_confirm/booking_confirm.php?" +
            responseData.booking_confirm;
        } else {
          window.location.href = `booking.php?success-booking=false&message=${responseData.message}&tour=${responseData.tour}&st_id=${responseData.st_id}&post_title=${responseData.post_title}&location=${responseData.location}&duration=${responseData.duration}&price=${responseData.price}&dateTour=${responseData.dateTour}&totalAdults=${responseData.totalAdults}&totalPrice=${responseData.totalPrice}`;
        }
      },
      error: function(xhr, ajaxOptions, thrownerror) {}
    });
  }
});

function checkBookingFirstName() {
  if (bookingFirstName.value === "") {
    bookingFirstName.classList.remove("is-valid");
    bookingFirstName.classList.add("is-invalid");
    return false;
  } else {
    bookingFirstName.classList.remove("is-invalid");
    bookingFirstName.classList.add("is-valid");
    return true;
  }
}

function checkBookingLastName() {
  if (bookingLastName.value === "") {
    bookingLastName.classList.remove("is-valid");
    bookingLastName.classList.add("is-invalid");
    return false;
  } else {
    bookingLastName.classList.remove("is-invalid");
    bookingLastName.classList.add("is-valid");
    return true;
  }
}

function checkBookingEmail() {
  const bookingEmailFeedback = document.getElementById(
    "booking-email-feedback"
  );
  if (bookingEmail.value === "") {
    bookingEmail.classList.remove("is-valid");
    bookingEmail.classList.add("is-invalid");
    bookingEmailFeedback.innerHTML = "Email tidak boleh kosong";
    return false;
  } else if (
    !/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
      bookingEmail.value
    )
  ) {
    bookingEmail.classList.remove("is-valid");
    bookingEmail.classList.add("is-invalid");
    bookingEmailFeedback.innerHTML = "Format email harus benar";
    return false;
  } else {
    bookingEmail.classList.remove("is-invalid");
    bookingEmail.classList.add("is-valid");
    return true;
  }
}

function checkBookingConfirmEmail() {
  const bookingVerifyEmailFeedback = document.getElementById(
    "booking-confirmEmail-feedback"
  );

  if (bookingVerifyEmail.value === "") {
    bookingVerifyEmail.classList.remove("is-valid");
    bookingVerifyEmail.classList.add("is-invalid");
    bookingVerifyEmailFeedback.innerHTML = "Email tidak boleh kosong";
    return false;
  } else if (
    !/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
      bookingEmail.value
    )
  ) {
    bookingVerifyEmail.classList.remove("is-valid");
    bookingVerifyEmail.classList.add("is-invalid");
    bookingVerifyEmailFeedback.innerHTML = "Format email harus benar";
    return false;
  } else {
    bookingVerifyEmail.classList.remove("is-invalid");
    bookingVerifyEmail.classList.add("is-valid");
    return true;
  }
}

function checkBookingPhoneNumber() {
  if (bookingPhoneNumber.value === "") {
    bookingPhoneNumber.classList.remove("is-valid");
    bookingPhoneNumber.classList.add("is-invalid");
    return false;
  } else {
    bookingPhoneNumber.classList.remove("is-invalid");
    bookingPhoneNumber.classList.add("is-valid");
    return true;
  }
}

function checkBookingZipCode() {
  if (bookingZipCode.value === "") {
    bookingZipCode.classList.remove("is-valid");
    bookingZipCode.classList.add("is-invalid");
    return false;
  } else {
    bookingZipCode.classList.remove("is-invalid");
    bookingZipCode.classList.add("is-valid");
    return true;
  }
}

function checkBookingAddress() {
  if (bookingAddress.value === "") {
    bookingAddress.classList.remove("is-valid");
    bookingAddress.classList.add("is-invalid");
    return false;
  } else {
    bookingAddress.classList.remove("is-invalid");
    bookingAddress.classList.add("is-valid");
    return true;
  }
}

function checkBookingCity() {
  if (bookingCity.value === "") {
    bookingCity.classList.remove("is-valid");
    bookingCity.classList.add("is-invalid");
    return false;
  } else {
    bookingCity.classList.remove("is-invalid");
    bookingCity.classList.add("is-valid");
    return true;
  }
}
