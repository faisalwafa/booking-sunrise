<?php

session_start();

include_once '../../helper/connection.php';

$is_logged_in = isset($_SESSION['user_id']);

$user;
if ($is_logged_in) {
    $user = $_SESSION["user_id"];
}


$tour_id = $_GET['tour'];
$st_id = $_GET['st_id'];
$post_title = $_GET['post_title'];
$location = $_GET['location'];
$duration = $_GET['duration'];
$tour_date = $_GET['dateTour'];
$price = $_GET['price'];
$total_adults = $_GET['totalAdults'];
$total_price = $_GET['totalPrice'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../inc/header.php'; ?>
    <title>Bookings Tours | Sunrise Indonesia</title>
</head>

<body>
    <?php include_once '../inc/navbar.php'; ?>
    <div class="page-title">
        <div class="container">
            <h2 style="margin-top: 10px;" class="post-title">Tour Booking </h2>
        </div>
    </div>
    <section id="content">
        <div class="container">
            <div id="main" class="entry-content">
                <div class="row">
                    <div class="col-sm-8 col-md-9">
                        <div class="booking-section">
                            <div class="person-information">
                                <h2 class="mb-4">Your Personal Information</h2>
                                <form class="booking-form" id="bookingForm">
                                    <input type="hidden" name="tour" value="<?= $tour_id ?>">
                                    <input type="hidden" name="stId" value="<?= $st_id ?>">
                                    <input type="hidden" name="tourDate" value="<?= $tour_date ?>">
                                    <input type="hidden" name="totalAdults" value="<?= $total_adults ?>">
                                    <input type="hidden" name="price" value="<?= $price ?>">
                                    <input type="hidden" name="totalPrice" value="<?= $total_price ?>">
                                    <input type="hidden" name="postTitle" value="<?= $post_title ?>">
                                    <input type="hidden" name="location" value="<?= $location ?>">
                                    <input type="hidden" name="duration" value="<?= $duration ?>">
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5 mb-3">
                                            <label>First Name</label>
                                            <input type="text" name="firstName" class="form-control" id="booking-firstName" value="<?php if ($is_logged_in) {
                                                                                                                                        echo $_SESSION['first_name'];
                                                                                                                                    } else {
                                                                                                                                        echo "";
                                                                                                                                    }  ?>" onfocusout="checkBookingFirstName()">
                                            <small class="invalid-feedback">Nama depan tidak boleh kosong</small>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Last Name</label>
                                            <input type="text" name="lastName" class="form-control" id="booking-lastName" value="<?php if ($is_logged_in) {
                                                                                                                                        echo $_SESSION['last_name'];
                                                                                                                                    } else {
                                                                                                                                        echo "";
                                                                                                                                    } ?> " onfocusout="checkBookingLastName()">
                                            <small class="invalid-feedback">Nama belakang tidak boleh kosong</small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5 mb-3">
                                            <label>Email Address</label>
                                            <input type="email" name="email" class="form-control" id="booking-email" value="<?php if ($is_logged_in) {
                                                                                                                                echo $_SESSION['user_email'];
                                                                                                                            } else {
                                                                                                                                echo "";
                                                                                                                            } ?>" onfocusout="checkBookingEmail()">
                                            <small class="invalid-feedback" id="booking-email-feedback">Email tidak boleh kosong</small>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Verify E-mail Address</label>
                                            <input type="email" name="confirmEmail" class="form-control" id="booking-verifyEmail" onfocusout="checkBookingConfirmEmail()">
                                            <small class="invalid-feedback" id="booking-confirmEmail-feedback">Email tidak cocok</small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5 mb-3">
                                            <label>Country Code</label>
                                            <select class="form-control" name="countryCode" id="booking-countryCode">
                                                <option value="+1">United States (+1)</option>
                                                <option value="+44">United Kingdom (+44)</option>
                                                <option value="+1">Canada (+1)</option>
                                                <option value="+93">Afghanistan (+93)</option>
                                                <option value="+355">Albania (+355)</option>
                                                <option value="+213">Algeria (+213)</option>
                                                <option value="+1">American Samoa (+1)</option>
                                                <option value="+376">Andorra (+376)</option>
                                                <option value="+244">Angola (+244)</option>
                                                <option value="+1">Anguilla (+1)</option>
                                                <option value="+1">Antigua (+1)</option>
                                                <option value="+54">Argentina (+54)</option>
                                                <option value="+374">Armenia (+374)</option>
                                                <option value="+297">Aruba (+297)</option>
                                                <option value="+61">Australia (+61)</option>
                                                <option value="+43">Austria (+43)</option>
                                                <option value="+994">Azerbaijan (+994)</option>
                                                <option value="+973">Bahrain (+973)</option>
                                                <option value="+880">Bangladesh (+880)</option>
                                                <option value="+1">Barbados (+1)</option>
                                                <option value="+375">Belarus (+375)</option>
                                                <option value="+32">Belgium (+32)</option>
                                                <option value="+501">Belize (+501)</option>
                                                <option value="+229">Benin (+229)</option>
                                                <option value="+1">Bermuda (+1)</option>
                                                <option value="+975">Bhutan (+975)</option>
                                                <option value="+591">Bolivia (+591)</option>
                                                <option value="+387">Bosnia and Herzegovina (+387)</option>
                                                <option value="+267">Botswana (+267)</option>
                                                <option value="+55">Brazil (+55)</option>
                                                <option value="+246">British Indian Ocean Territory (+246)</option>
                                                <option value="+1">British Virgin Islands (+1)</option>
                                                <option value="+673">Brunei (+673)</option>
                                                <option value="+359">Bulgaria (+359)</option>
                                                <option value="+226">Burkina Faso (+226)</option>
                                                <option value="+95">Burma Myanmar (+95)</option>
                                                <option value="+257">Burundi (+257)</option>
                                                <option value="+855">Cambodia (+855)</option>
                                                <option value="+237">Cameroon (+237)</option>
                                                <option value="+238">Cape Verde (+238)</option>
                                                <option value="+1">Cayman Islands (+1)</option>
                                                <option value="+236">Central African Republic (+236)</option>
                                                <option value="+235">Chad (+235)</option>
                                                <option value="+56">Chile (+56)</option>
                                                <option value="+86">China (+86)</option>
                                                <option value="+57">Colombia (+57)</option>
                                                <option value="+269">Comoros (+269)</option>
                                                <option value="+682">Cook Islands (+682)</option>
                                                <option value="+506">Costa Rica (+506)</option>
                                                <option value="+225">Cote d&#039;Ivoire (+225)</option>
                                                <option value="+385">Croatia (+385)</option>
                                                <option value="+53">Cuba (+53)</option>
                                                <option value="+357">Cyprus (+357)</option>
                                                <option value="+420">Czech Republic (+420)</option>
                                                <option value="+243">Democratic Republic of Congo (+243)</option>
                                                <option value="+45">Denmark (+45)</option>
                                                <option value="+253">Djibouti (+253)</option>
                                                <option value="+1">Dominica (+1)</option>
                                                <option value="+1">Dominican Republic (+1)</option>
                                                <option value="+593">Ecuador (+593)</option>
                                                <option value="+20">Egypt (+20)</option>
                                                <option value="+503">El Salvador (+503)</option>
                                                <option value="+240">Equatorial Guinea (+240)</option>
                                                <option value="+291">Eritrea (+291)</option>
                                                <option value="+372">Estonia (+372)</option>
                                                <option value="+251">Ethiopia (+251)</option>
                                                <option value="+500">Falkland Islands (+500)</option>
                                                <option value="+298">Faroe Islands (+298)</option>
                                                <option value="+691">Federated States of Micronesia (+691)</option>
                                                <option value="+679">Fiji (+679)</option>
                                                <option value="+358">Finland (+358)</option>
                                                <option value="+33">France (+33)</option>
                                                <option value="+594">French Guiana (+594)</option>
                                                <option value="+689">French Polynesia (+689)</option>
                                                <option value="+241">Gabon (+241)</option>
                                                <option value="+995">Georgia (+995)</option>
                                                <option value="+49">Germany (+49)</option>
                                                <option value="+233">Ghana (+233)</option>
                                                <option value="+350">Gibraltar (+350)</option>
                                                <option value="+30">Greece (+30)</option>
                                                <option value="+299">Greenland (+299)</option>
                                                <option value="+1">Grenada (+1)</option>
                                                <option value="+590">Guadeloupe (+590)</option>
                                                <option value="+1">Guam (+1)</option>
                                                <option value="+502">Guatemala (+502)</option>
                                                <option value="+224">Guinea (+224)</option>
                                                <option value="+245">Guinea-Bissau (+245)</option>
                                                <option value="+592">Guyana (+592)</option>
                                                <option value="+509">Haiti (+509)</option>
                                                <option value="+504">Honduras (+504)</option>
                                                <option value="+852">Hong Kong (+852)</option>
                                                <option value="+36">Hungary (+36)</option>
                                                <option value="+354">Iceland (+354)</option>
                                                <option value="+91">India (+91)</option>
                                                <option value="+62">Indonesia (+62)</option>
                                                <option value="+98">Iran (+98)</option>
                                                <option value="+964">Iraq (+964)</option>
                                                <option value="+353">Ireland (+353)</option>
                                                <option value="+972">Israel (+972)</option>
                                                <option value="+39">Italy (+39)</option>
                                                <option value="+1">Jamaica (+1)</option>
                                                <option value="+81">Japan (+81)</option>
                                                <option value="+962">Jordan (+962)</option>
                                                <option value="+7">Kazakhstan (+7)</option>
                                                <option value="+254">Kenya (+254)</option>
                                                <option value="+686">Kiribati (+686)</option>
                                                <option value="+381">Kosovo (+381)</option>
                                                <option value="+965">Kuwait (+965)</option>
                                                <option value="+996">Kyrgyzstan (+996)</option>
                                                <option value="+856">Laos (+856)</option>
                                                <option value="+371">Latvia (+371)</option>
                                                <option value="+961">Lebanon (+961)</option>
                                                <option value="+266">Lesotho (+266)</option>
                                                <option value="+231">Liberia (+231)</option>
                                                <option value="+218">Libya (+218)</option>
                                                <option value="+423">Liechtenstein (+423)</option>
                                                <option value="+370">Lithuania (+370)</option>
                                                <option value="+352">Luxembourg (+352)</option>
                                                <option value="+853">Macau (+853)</option>
                                                <option value="+389">Macedonia (+389)</option>
                                                <option value="+261">Madagascar (+261)</option>
                                                <option value="+265">Malawi (+265)</option>
                                                <option value="+60">Malaysia (+60)</option>
                                                <option value="+960">Maldives (+960)</option>
                                                <option value="+223">Mali (+223)</option>
                                                <option value="+356">Malta (+356)</option>
                                                <option value="+692">Marshall Islands (+692)</option>
                                                <option value="+596">Martinique (+596)</option>
                                                <option value="+222">Mauritania (+222)</option>
                                                <option value="+230">Mauritius (+230)</option>
                                                <option value="+262">Mayotte (+262)</option>
                                                <option value="+52">Mexico (+52)</option>
                                                <option value="+373">Moldova (+373)</option>
                                                <option value="+377">Monaco (+377)</option>
                                                <option value="+976">Mongolia (+976)</option>
                                                <option value="+382">Montenegro (+382)</option>
                                                <option value="+1">Montserrat (+1)</option>
                                                <option value="+212">Morocco (+212)</option>
                                                <option value="+258">Mozambique (+258)</option>
                                                <option value="+264">Namibia (+264)</option>
                                                <option value="+674">Nauru (+674)</option>
                                                <option value="+977">Nepal (+977)</option>
                                                <option value="+31">Netherlands (+31)</option>
                                                <option value="+599">Netherlands Antilles (+599)</option>
                                                <option value="+687">New Caledonia (+687)</option>
                                                <option value="+64">New Zealand (+64)</option>
                                                <option value="+505">Nicaragua (+505)</option>
                                                <option value="+227">Niger (+227)</option>
                                                <option value="+234">Nigeria (+234)</option>
                                                <option value="+683">Niue (+683)</option>
                                                <option value="+672">Norfolk Island (+672)</option>
                                                <option value="+850">North Korea (+850)</option>
                                                <option value="+1">Northern Mariana Islands (+1)</option>
                                                <option value="+47">Norway (+47)</option>
                                                <option value="+968">Oman (+968)</option>
                                                <option value="+92">Pakistan (+92)</option>
                                                <option value="+680">Palau (+680)</option>
                                                <option value="+970">Palestine (+970)</option>
                                                <option value="+507">Panama (+507)</option>
                                                <option value="+675">Papua New Guinea (+675)</option>
                                                <option value="+595">Paraguay (+595)</option>
                                                <option value="+51">Peru (+51)</option>
                                                <option value="+63">Philippines (+63)</option>
                                                <option value="+48">Poland (+48)</option>
                                                <option value="+351">Portugal (+351)</option>
                                                <option value="+1">Puerto Rico (+1)</option>
                                                <option value="+974">Qatar (+974)</option>
                                                <option value="+242">Republic of the Congo (+242)</option>
                                                <option value="+262">Reunion (+262)</option>
                                                <option value="+40">Romania (+40)</option>
                                                <option value="+7">Russia (+7)</option>
                                                <option value="+250">Rwanda (+250)</option>
                                                <option value="+590">Saint Barthelemy (+590)</option>
                                                <option value="+290">Saint Helena (+290)</option>
                                                <option value="+1">Saint Kitts and Nevis (+1)</option>
                                                <option value="+590">Saint Martin (+590)</option>
                                                <option value="+508">Saint Pierre and Miquelon (+508)</option>
                                                <option value="+1">Saint Vincent and the Grenadines (+1)</option>
                                                <option value="+685">Samoa (+685)</option>
                                                <option value="+378">San Marino (+378)</option>
                                                <option value="+239">Sao Tome and Principe (+239)</option>
                                                <option value="+966">Saudi Arabia (+966)</option>
                                                <option value="+221">Senegal (+221)</option>
                                                <option value="+381">Serbia (+381)</option>
                                                <option value="+248">Seychelles (+248)</option>
                                                <option value="+232">Sierra Leone (+232)</option>
                                                <option value="+65">Singapore (+65)</option>
                                                <option value="+421">Slovakia (+421)</option>
                                                <option value="+386">Slovenia (+386)</option>
                                                <option value="+677">Solomon Islands (+677)</option>
                                                <option value="+252">Somalia (+252)</option>
                                                <option value="+27">South Africa (+27)</option>
                                                <option value="+82">South Korea (+82)</option>
                                                <option value="+34">Spain (+34)</option>
                                                <option value="+94">Sri Lanka (+94)</option>
                                                <option value="+1">St. Lucia (+1)</option>
                                                <option value="+249">Sudan (+249)</option>
                                                <option value="+597">Suriname (+597)</option>
                                                <option value="+268">Swaziland (+268)</option>
                                                <option value="+46">Sweden (+46)</option>
                                                <option value="+41">Switzerland (+41)</option>
                                                <option value="+963">Syria (+963)</option>
                                                <option value="+886">Taiwan (+886)</option>
                                                <option value="+992">Tajikistan (+992)</option>
                                                <option value="+255">Tanzania (+255)</option>
                                                <option value="+66">Thailand (+66)</option>
                                                <option value="+1">The Bahamas (+1)</option>
                                                <option value="+220">The Gambia (+220)</option>
                                                <option value="+670">Timor-Leste (+670)</option>
                                                <option value="+228">Togo (+228)</option>
                                                <option value="+690">Tokelau (+690)</option>
                                                <option value="+676">Tonga (+676)</option>
                                                <option value="+1">Trinidad and Tobago (+1)</option>
                                                <option value="+216">Tunisia (+216)</option>
                                                <option value="+90">Turkey (+90)</option>
                                                <option value="+993">Turkmenistan (+993)</option>
                                                <option value="+1">Turks and Caicos Islands (+1)</option>
                                                <option value="+688">Tuvalu (+688)</option>
                                                <option value="+256">Uganda (+256)</option>
                                                <option value="+380">Ukraine (+380)</option>
                                                <option value="+971">United Arab Emirates (+971)</option>
                                                <option value="+598">Uruguay (+598)</option>
                                                <option value="+1">US Virgin Islands (+1)</option>
                                                <option value="+998">Uzbekistan (+998)</option>
                                                <option value="+678">Vanuatu (+678)</option>
                                                <option value="+39">Vatican City (+39)</option>
                                                <option value="+58">Venezuela (+58)</option>
                                                <option value="+84">Vietnam (+84)</option>
                                                <option value="+681">Wallis and Futuna (+681)</option>
                                                <option value="+967">Yemen (+967)</option>
                                                <option value="+260">Zambia (+260)</option>
                                                <option value="+263">Zimbabwe (+263)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Phone Number</label>
                                            <input type="text" name="phoneNumber" class="form-control" id="booking-phoneNumber" onfocusout="checkBookingPhoneNumber()">
                                            <small class="invalid-feedback">No. Telefon tidak boleh kosong</small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5 mb-3">
                                            <label>Address</label>
                                            <input type="text" name="address" class="form-control" id="booking-address" onfocusout="checkBookingAddress()">
                                            <small class="invalid-feedback">Address tidak boleh kosong</small>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>City</label>
                                            <input type="text" name="city" class="form-control" id="booking-city" onfocusout="checkBookingCity()">
                                            <small class="invalid-feedback">City code tidak boleh kosong</small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5 mb-3">
                                            <label>Zip Code</label>
                                            <input type="text" name="zipCode" class="form-control" id="booking-zipCode" onfocusout="checkBookingZipCode()">
                                            <small class="invalid-feedback">Postal code tidak boleh kosong</small>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Country</label>
                                            <select class="form-control" name="country" id="booking-country">
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
                                            <textarea class="form-control" name="specialReq" id="booking-specialReq" rows="4"></textarea>
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
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="booking-details">
                            <h4>Booking Details</h4>
                            <div class="">
                                <h6>
                                    <a class="text-decoration-none" href="../tour/tour.php?tour=<?= $tour_id ?>">
                                        <?= $post_title ?>
                                    </a>
                                </h6>
                                <div class="d-flex justify-content-end">
                                    <button class="d-inline btn btn-outline-green ">Edit</button>
                                </div>
                            </div>
                            <hr>
                            <div class="media d-flex align-items-center">
                                <h2><i class="far fa-calendar-alt text-orange"></i></h2>
                                <div class="media-body ml-3">
                                    <p class="mt-0 mb-1 text-info mb-0">Date</p>
                                    <p class="mb-0"><?= $tour_date ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="media d-flex align-items-center">
                                <h2><i class="far fa-clock text-orange"></i></h2>
                                <div class="media-body ml-3">
                                    <p class="mt-0 mb-1 text-info mb-0">Duration</p>
                                    <p class="mb-0"><?= $duration ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="media d-flex align-items-center">
                                <h2><i class="fas fa-map-marker-alt text-orange"></i></h2>
                                <div class="media-body ml-3">
                                    <p class="mt-0 mb-1 text-info mb-0">Location</p>
                                    <p class="mb-0"><?= $location ?></p>
                                </div>
                            </div>
                            <hr>
                            <h6>Other Details</h6>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p class="text-info mb-0">Harga per Orang</p>
                                <p class="mb-0">Rp. <?= number_format($price, 0, ".", ".") ?></p>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p class="text-info mb-0">Jumlah Orang</p>
                                <p class="mb-0"><?= $total_adults ?></p>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-0 font-weight-bold">Total Biaya</h6>
                                <h6 class="mb-0 text-green">Rp. <?= number_format($total_price, 0, ".", ".") ?></h6>
                            </div>
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