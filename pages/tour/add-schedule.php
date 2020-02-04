<?php
include_once '../../helper/connection.php';

$tour = $_GET['tour'];

$sql = "SELECT post_title FROM wpzu_posts WHERE ID = $tour";
$results = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($results);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../inc/header.php'; ?>
    <title>Schedule | Sunrise Indonesia</title>
</head>

<body>
    <div class="container">
        <h4>Add New Tour Schedule</h4>
        <form method="post" action="add-schedule_action.php">
            <input type="hidden" name="tour_id" value="<?= $tour ?>">
            <div class="form-group row">
                <h5 class="col-sm-3 mt-3">Tour</h5>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?= $row['post_title'] ?>" />
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-3 mt-3">Schedule Type</h5>
                <div class="col-sm-9">
                    <select class="form-control" name="scheduleType">
                        <option value="0"></option>
                        <option value="0">Weekday</option>
                        <option value="1">Weekend</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-3 mt-3">Pax</h5>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="maxPeople" min="1" value="1" />
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-3 mt-3">Min People</h5>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="minPeople" min="1" />
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-3 mt-3">Duration</h5>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="duration" />
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-3 mt-3">Is Daily?</h5>
                <div class="col-sm-9">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="isDaily" onchange="myFunction()" id="check">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-3 mt-3">Tour Date</h5>
                <div class="col-sm-9">
                    <input type="date" class="form-control" name="tourDate" />
                </div>
            </div>
            <div id="endDate" style="display: none">
                <div class="form-group row">
                    <h5 class="col-sm-3 mt-3">End Date</h5>
                    <div class="col-sm-9">
                        <input id="inputEndDate" type="date" class="form-control" name="endDate" />
                    </div>
                </div>
            </div>
            <div class=" form-group row">
                <h5 class="col-sm-3 mt-3">Charge Per Person?</h5>
                <div class="col-sm-9">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="perPerson" onchange="myFunction2()" id="check2">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-3 mt-3">Price</h5>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="price" />
                </div>
            </div>
            <div id="childPrice" style="display: none">
                <div class="form-group row">
                    <h5 class="col-sm-3 mt-3">Price Per Child</h5>
                    <div class="col-sm-9">
                        <input id="inputChildPrice" type="text" class="form-control" name="childPrice" />
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-3 mt-3">Member Price</h5>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="memberPrice" />
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 "></div>
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary">Save Schedule</button>
                </div>
            </div>
        </form>
    </div>
    <?php include_once '../inc/scripts.php'; ?>
</body>

</html>