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