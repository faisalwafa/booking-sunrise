<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking | Sunrise Indonesia</title>
    <style>
        .wrapper {
            margin: 0 auto;
            width: 40%;
        }

        #booking {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #booking td,
        #booking th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #booking tr:hover {
            background-color: #ddd;
        }

        #booking th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: white;
            color: #FFA500;
        }

        @media only screen and (max-width: 600px) {
            .wrapper {
                width: 90%;
            }

            .overflow {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body style="background: #f3f3f3; font-family:Arial, Helvetica, sans-serif;">
    <div class="wrapper">
        <img style="margin: 20px 0px;  display: block;
                        margin-left: auto;
                        margin-right: auto;" src="http://booking.sunrise-indonesia.com/assets/logo-pwa.png" alt="logo" width="120">
        <div style="background: white; padding: 15px 30px 20px 30px;">
            <h3>Informasi Pemesanan</h3>
            <a href="http://booking.sunrise-indonesia.com/pages/booking_confirm/booking_confirm.php?booking_confirm=' . $bookingCode . '" style="font-size:0.8rem; text-decoration:none; color:white; padding:10px 15px; background-color:#FFA500; border-radius:10%; margin-bottom: 10px">Tour Order Detail</a>
            <br>
            <br>
            <hr>
            <div class="overflow">
                <table id="booking">
                    <tr>
                        <th width="40%">Booking Number:</th>
                        <td>' . $bookingCode . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Name:</th>
                        <td>' . $first_name . ' ' . $last_name . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Phone:</th>
                        <td>' . $phone_number . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Tour Name:</th>
                        <td>' . $post_title . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Tour Date:</th>
                        <td>' . $tour_date . '</td>
                    </tr>
                    <tr>
                        <th width="40%">PAX:</th>
                        <td>' . $total_adults . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Booking Date:</th>
                        <td>' . date("Y-m-d") . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Special Requirement:</th>
                        <td>' . $special_req . '</td>
                    </tr>
                    <tr>
                        <th width="40%">Total Price:</th>
                        <td><b>' . $total_price . '</b></td>
                    </tr>
                </table>
            </div>
            <hr>
            <small><strong>*Terima Kasih, Order telah berhasil diproses, Tim CS akan segera menghubungi anda</strong></small>
        </div>
        <p style="margin-top: 20px; text-align:center;">
            <small>
                Copyright © 2020 Sunrise Indonesia
                All rights reserved.
            </small>
        </p>
    </div>
</body>

</html