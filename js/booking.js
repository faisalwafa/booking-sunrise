const bookingFirstName = document.getElementById("booking-firstName");
const bookingLastName = document.getElementById("booking-lastName");
const bookingEmail = document.getElementById("booking-email");
const bookingVerifyEmail = document.getElementById("booking-verifyEmail");
const bookingPhoneNumber = document.getElementById("booking-phoneNumber");
const bookingZipCode = document.getElementById("booking-zipCode");
const formBooking = document.getElementById("bookingForm");

formBooking.addEventListener("submit", function(e) {
    e.preventDefault();
    if (
        checkBookingFirstName() &&
        checkBookingLastName() &&
        checkBookingEmail() &&
        checkBookingConfirmEmail() &&
        checkBookingPhoneNumber() &&
        checkBookingZipCode()
    ) {
        $.ajax({
            type: "POST",
            url: "booking_action.php",
            data: {
                first_name: bookingFirstName.value,
                last_name: bookingLastName.value,
                email: bookingEmail.value,
                verifyEmail: bookingVerifyEmail.value,
                number: bookingPhoneNumber.value,
                postalCode: bookingZipCode.value
            },
            success: function(data) {
                let response = JSON.parse(data);
                if (response.success === "success") {
                    window.location.href = "booking.php";
                } else {
                    window.location.href =
                        "booking.php?success-booking=false&message=" + response.message;
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
    const bookingEmailFeedback = document.getElementById("booking-email-feedback");
    if (bookingEmail.value === "") {
        bookingEmail.classList.remove("is-valid");
        bookingEmail.classList.add("is-invalid");
        bookingEmailFeedback.innerHTML = "Email tidak boleh kosong";
        return false;
    } else if (!/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
            bookingEmail.value
        )) {
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
    const bookingVerifyEmailFeedback = document.getElementById("booking-confirmEmail-feedback");

    if (bookingVerifyEmail.value === "") {
        bookingVerifyEmail.classList.remove("is-valid");
        bookingVerifyEmail.classList.add("is-invalid");
        bookingVerifyEmailFeedback.innerHTML = "Email tidak boleh kosong";
        return false;
    } else if (!/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
            bookingEmail.value
        )) {
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