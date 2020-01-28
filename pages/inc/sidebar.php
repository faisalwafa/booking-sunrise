<?php
$sql_last_minute_deals = "SELECT ID, post_title FROM `wpzu_posts` WHERE `post_status` = 'publish' AND `post_type` = 'tour' ORDER BY `post_date` DESC LIMIT 3";
?>
<div class=" content p-2">
    <h6 class="p-1">Last Minute Deals</h6>
    <?php
    $results_last_minute_deals = mysqli_query($con, $sql_last_minute_deals);
    while ($row_last_minute_deals = mysqli_fetch_assoc($results_last_minute_deals)) {
        $post_id = $row_last_minute_deals['ID'];

        $sql_thumbnail_price = "SELECT * FROM `wpzu_postmeta` WHERE (`post_id` = $post_id) AND (`meta_key` = 'trav_tour_min_price' OR `meta_key` = '_thumbnail_id') ORDER BY `wpzu_postmeta`.`meta_key` ASC";

        $result_thumbnail_price = mysqli_query($con, $sql_thumbnail_price);

        $i = 0;
        $post_id_thumbnail;
        $tour_min_price;

        while ($row_thumbnail_price = mysqli_fetch_assoc($result_thumbnail_price)) {
            if ($i == 0) {
                $post_id_thumbnail = $row_thumbnail_price['meta_value'];
            } else {
                $tour_min_price = $row_thumbnail_price['meta_value'];
            }
            $i++;
        }
        $sql_thumbnail = "SELECT guid FROM wpzu_posts WHERE ID = $post_id_thumbnail";
        $result_thumbnail = mysqli_query($con, $sql_thumbnail);
        $row_thumbnail = mysqli_fetch_assoc($result_thumbnail);
        $thumbnail_src = substr($row_thumbnail['guid'], strpos($row_thumbnail['guid'], "/wp-content") + 1);
    ?>
        <div class="px-2 d-flex align-items-start">
            <div class="mr-2">
                <img src="http://sunrise-indonesia.com/<?= $thumbnail_src ?>" alt="thumbnail-image" width="64" height="64">
            </div>
            <div>
                <a class="text-dark text-decoration-none" href="../tour/tour.php?tour=<?= $post_id; ?>">
                    <h6 class="sidebar-li-title"><?= $row_last_minute_deals['post_title'] ?></h6>
                </a>
                <span>
                    <span>
                        <h6 class="d-inline text-green sidebar-li-title">IDR<?= number_format($tour_min_price, 0, ".", ".") ?></h6>
                        <small class="text-secondary"> &nbsp; PER PERSON</small>
                    </span>
                </span>
            </div>
        </div>
        <hr>
    <?php } ?>
</div>
<div class=" content mt-4 p-2">
    <h6 class="p-1">Kenapa Booking Melalui Kami?</h6>
    <br>
    <div class="px-2 d-flex align-items-start">
        <div class="mr-2">
            <i class="soap-icon-hotel-1 circle sidebar-icon"></i>
        </div>
        <div>
            <h6 class="sidebar-li-title">200+ Hotels</h6>
            <span>200+ Jaringan Hotel Di Seluruh Indonesia.</span>
        </div>
    </div>
    <hr>
    <div class="px-2 d-flex align-items-start">
        <div class="mr-2">
            <i class="soap-icon-savings circle sidebar-icon"></i>
        </div>
        <div>
            <h6 class="sidebar-li-title">Low Rates & Savings</h6>
            <span>Garansi Harga Paling Murah.</span>
        </div>
    </div>
    <hr>
    <div class="px-2 d-flex align-items-start mb-2">
        <div class="mr-2">
            <i class="soap-icon-support circle sidebar-icon"></i>
        </div>
        <div>
            <h6 class="sidebar-li-title">Excellent Support</h6>
            <span>Customer Service 24/7.</span>
        </div>
    </div>
</div>
<div class=" content mt-4 p-2">
    <h6 class="p-1">Butuh Bantuan Kami ?</h6>
    <p>Teman Setia Perjalanan Wisata Anda, dengan senang hati kami melayani anda dengan support customer service 24/7</p>
    <div class="px-2 d-flex align-items-start mb-2">
        <div class="mr-2 mt-1">
            <i class="soap-icon-phone sidebar-icon"></i>
        </div>
        <div>
            <h5 class="contact"> +6287 777 890 888</h5>
            <a class="email" href="mailto:info@sunrise-indonesia.com">info@sunrise-indonesia.com</a>
        </div>
    </div>
</div>