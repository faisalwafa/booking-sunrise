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

        .text-center {
            text-align: center;
        }

        .text-blue {
            color: #5EA0C7;
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
            <h3>Konfirmasi Booking Tour</h3>
            <h4>Terima Kasih telah melakukan konfirmasi booking</h4>
            <hr>
            <br>
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
                </table>
            </div>
            <br>
            <a href="http://booking.sunrise-indonesia.com/pages/booking_confirm/booking_confirm.php?booking_confirm=' . $bookingCode . '" style="font-size:0.8rem; text-decoration:none; color:white; padding:10px 15px; background-color:#FFA500; border-radius:10%; margin-bottom: 10px">Tour Order Detail</a>
            <br>
            <br>
            <hr>
        </div>
        <p style="margin-top: 20px; text-align:center;">
            <small>
                Copyright © 2020 Sunrise Indonesia
                All rights reserved.
            </small>
        </p>
    </div>
</body>

</html>