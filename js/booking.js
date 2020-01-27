const bookingFirstName = document.getElementById("booking-firstName");
const bookingLastName = document.getElementById("booking-lastName");
const bookingEmail = document.getElementById("booking-email");
const bookingVerifyEmail = document.getElementById("booking-verifyEmail");
const bookingPhoneNumber = document.getElementById("booking-phoneNumber");
const bookingZipCode = document.getElementById("booking-zipCode");

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
    if (bookingEmail.value === "") {
        bookingEmail.classList.remove("is-valid");
        bookingEmail.classList.add("is-invalid");
        return false;
    } else {
        bookingEmail.classList.remove("is-invalid");
        bookingEmail.classList.add("is-valid");
        return true;
    }
}

function checkBookingConfirmEmail() {
    if (bookingVerifyEmail.value === "") {
        bookingVerifyEmail.classList.remove("is-valid");
        bookingVerifyEmail.classList.add("is-invalid");
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