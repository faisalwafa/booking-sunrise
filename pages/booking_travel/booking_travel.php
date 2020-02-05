<?php
session_start();

include_once '../../helper/connection.php';

$is_logged_in = isset($_SESSION['user_id']);

$user;
if ($is_logged_in) {
    $user = $_SESSION["user_id"];
}

$travel_id = $_GET['travel'];

// $sql = "SELECT b.travel_id , c.location_from , c.location_to , c.schedule , c.price , c.price_member FROM wpzu_trav_city c INNER JOIN wpzu_trav_city_bookings b ON c.travel_id = b.id WHERE travel_id = $travel_id";

$sql = "SELECT * FROM wpzu_trav_city WHERE id = $travel_id";
$results = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($results);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../inc/header.php'; ?>
    <title>Bookings Travel Antar Kota | Sunrise Indonesia</title>
</head>

<body>
    <?php include_once '../inc/navbar.php'; ?>
    <div class="page-title">
        <div class="container">
            <h2 style="margin-top: 10px;" class="post-title">Travel Antar Kota Booking </h2>
        </div>
    </div>
    <section id="content">
        <div class="container">
            <div id="main" class="entry-content">
                <div class="row">
                    <div class="col-sm-8 col-md-9">
                        <div class="booking-section">
                            <h2 class="mb-4">Your Personal Information</h2>
                            <form class="bookingTravel-form" id="travelBookingForm">
                                <div class="form-group row">
                                    <div class="col-sm-6 col-md-5 mb-3">
                                        <label>First Name</label>
                                        <input type="text" name="firstNameTravel" class="form-control" id="travelBooking-firstName" onfocusout="checkBookingTravelFirstName()" value="<?php if ($is_logged_in) {
                                                                                                                                                                                            echo $_SESSION['first_name'];
                                                                                                                                                                                        } else {
                                                                                                                                                                                            echo "";
                                                                                                                                                                                        }  ?>">
                                        <small class="invalid-feedback">Nama depan tidak boleh kosong</small>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-sm-6 col-md-5 mb-3">
                                        <label>Last Name</label>
                                        <input type="text" name="lastNameTravel" class="form-control" id="travelBooking-lastName" onfocusout="checkBookingTravelLastName()" value="<?php if ($is_logged_in) {
                                                                                                                                                                                        echo $_SESSION['last_name'];
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo "";
                                                                                                                                                                                    } ?> ">
                                        <small class="invalid-feedback">Nama belakang tidak boleh kosong</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-md-5 mb-3">
                                        <label>Email Address</label>
                                        <input type="email" name="emailTravel" class="form-control" id="travelBooking-email" onfocusout="checkBookingTravelEmail()" value="<?php if ($is_logged_in) {
                                                                                                                                                                                echo $_SESSION['user_email'];
                                                                                                                                                                            } else {
                                                                                                                                                                                echo "";
                                                                                                                                                                            } ?>">
                                        <small class="invalid-feedback" id="bookingTravel-email-feedback">Email tidak boleh kosong</small>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-sm-6 col-md-5 mb-3">
                                        <label>Verify E-mail Address</label>
                                        <input type="email" name="confirmEmailTravel" class="form-control" id="travelBooking-emailVerify" onfocusout="checkBookingTravelConfirmEmail()" value="">
                                        <small class="invalid-feedback" id="bookingTravel-confirmEmail-feedback">Email tidak cocok</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-md-5 mb-3">
                                        <label>Jumlah Pax</label>
                                        <input type="number" name="confirmPaxTravel" class="form-control" id="travelBooking-pax" onfocusout="checkBookingTravelPax()" min="1" value="1">
                                        <small class="invalid-feedback">Pax minimal 1</small>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-sm-6 col-md-5">
                                        <label>Phone Number</label>
                                        <input type="text" name="phoneNumberTravel" class="form-control" id="travelBooking-phoneNumber" onfocusout="checkBookingTravelPhoneNumber()">
                                        <small class="invalid-feedback">No. Telepon tidak boleh kosong</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-md-5 mb-3">
                                        <label>Pick Up Date</label>
                                        <input type="date" name="dateTravel" class="form-control" id="travelBooking-date" required>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-sm-6 col-md-5 mb-3">
                                        <label>Pick Up Time</label>
                                        <select name="confirmEmailTravel" class="form-control" id="travelBooking-time" required>
                                            <?php
                                            $results_travel_time = mysqli_query($con, "SELECT available_time FROM wpzu_trav_city_schedule WHERE id_travel = $travel_id");
                                            while ($row_travel_time = mysqli_fetch_assoc($results_travel_time)) {
                                            ?>
                                                <option value="<?= $row_travel_time['available_time'] ?>"><?= $row_travel_time['available_time'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-md-5 mb-3">
                                        <label>Pick Up Location</label>
                                        <input type="text" name="locationTravel" class="form-control" id="travelBooking-location" onfocusout="checkBookingTravelLocation()">
                                        <small class="invalid-feedback">Lokasi penjemputan tidak boleh kosong</small>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-sm-6 col-md-5">
                                        <label>Country</label>
                                        <select class="form-control" name="countryTravel" id="travelBooking-country">
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="United States">United States</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antigua">Antigua</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                            <option value="British Virgin Islands">British Virgin Islands</option>
                                            <option value="Brunei">Brunei</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burma Myanmar">Burma Myanmar</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote d&#039;Ivoire">Cote d&#039;Ivoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Democratic Republic of Congo">Democratic Republic of Congo</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands">Falkland Islands</option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Federated States of Micronesia">Federated States of Micronesia</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Iran">Iran</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Kosovo">Kosovo</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Laos">Laos</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libya">Libya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macau">Macau</option>
                                            <option value="Macedonia">Macedonia</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Moldova">Moldova</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="North Korea">North Korea</option>
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestine">Palestine</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Republic of the Congo">Republic of the Congo</option>
                                            <option value="Reunion">Reunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russia">Russia</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Barthelemy">Saint Barthelemy</option>
                                            <option value="Saint Helena">Saint Helena</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="Saint Martin">Saint Martin</option>
                                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                            <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Korea">South Korea</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="St. Lucia">St. Lucia</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syria">Syria</option>
                                            <option value="Taiwan">Taiwan</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania">Tanzania</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="The Bahamas">The Bahamas</option>
                                            <option value="The Gambia">The Gambia</option>
                                            <option value="Timor-Leste">Timor-Leste</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="US Virgin Islands">US Virgin Islands</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Vatican City">Vatican City</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Vietnam">Vietnam</option>
                                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-11 mb-3">
                                        <label>Special requirements</label>
                                        <textarea class="form-control" name="specialReqTravel" id="travelBooking-specialReq" rows="4"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="ml-3 col-sm-12 col-md-4">
                                        <div class="g-recaptcha" data-sitekey="6LcMA9MUAAAAAG_pihWoBXmp9S5vlGxdVgvywsQ3"></div>
                                    </div>
                                </div>
                                <hr style="margin-top: 20px">
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input value="agree" type="checkbox" checked>
                                            By Continuing, you agree to the
                                            <a href="https://sunrise-indonesia.com/booking-terms-condition/" target="_blank">
                                                Terms and Conditions.
                                            </a>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-md-5">
                                        <button type="submit" class="btn btn-green btn-block">CONFIRM BOOKING</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="booking-details">
                            <h4>Booking Details</h4>
                            <div class="">
                                <h6>
                                    <a class="text-decoration-none" href="#">
                                        <?= $row['location_from'] ?>-<?= $row['location_to'] ?>
                                    </a>
                                </h6>
                            </div>
                            <hr>
                            <div class="media d-flex align-items-center">
                                <h2><i class="fas fa-route text-orange"></i></h2>
                                <div class="media-body ml-3">
                                    <p class="mt-0 mb-1 text-info mb-0">Travel</p>
                                    <p class="mb-0"><?= $row['location_from'] ?>-<?= $row['location_to'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="media d-flex align-items-center">
                                <h2><i class="far fa-clock text-orange"></i></h2>
                                <div class="media-body ml-3">
                                    <p class="mt-0 mb-1 text-info mb-0">Schedule</p>
                                    <p class="mb-0"><?= $row['schedule'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <h6>Other Details</h6>
                            <hr>
                            <?php
                            if (!$is_logged_in) { ?>
                                <div class="d-flex justify-content-between">
                                    <p class="text-info mb-0">Harga per Orang</p>
                                    <p id="travelBooking-price" class="mb-0">Rp. <?= number_format($row['price'], 0, ".", ".") ?></p>
                                </div>
                            <?php } else { ?>
                                <div class="d-flex justify-content-between">
                                    <p class="text-info mb-0">Harga per Orang</p>
                                    <p id="travelBooking-price" class="mb-0">Rp. <?= number_format($row['price_member'], 0, ".", ".") ?></p>
                                </div>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <?php include_once '../inc/footer.php'; ?>
    <?php include_once '../inc/scripts.php'; ?>

</body>

</html>