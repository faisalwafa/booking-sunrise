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
            <div class="form-group row">
                <h5 class="col-sm-2 mt-3">Tour</h5>
                <div class="col-sm-10"> 
                <select class="form-control">
                    <option></option>
                </select>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-2 mt-3">Max People</h5>
                <div class="col-sm-10"> 
                <input type="number" class="form-control" name="maxPeople"/>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-2 mt-3">Duration</h5>
                <div class="col-sm-10"> 
                <input type="text" class="form-control" name="duration"/>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-2 mt-3">Is Daily?</h5>
                <div class="col-sm-10"> 
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">  
                    </div>  
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-2 mt-3">Start Date</h5>
                <div class="col-sm-10"> 
                <input type="date" class="form-control" name="startDate"/>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-2 mt-3">End Date</h5>
                <div class="col-sm-10"> 
                <input type="date" class="form-control" name="endDate"/>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-2 mt-3">Tour Date</h5>
                <div class="col-sm-10"> 
                <input type="date" class="form-control" name="tourDate"/>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-2 mt-3">Charge Per Person?</h5>
                <div class="col-sm-10"> 
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1"> 
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-2 mt-3">Price Per Adult</h5>
                <div class="col-sm-10"> 
                <input type="text" class="form-control" name="price"/>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-2 mt-3">Price Per Child</h5>
                <div class="col-sm-10"> 
                <input type="text" class="form-control" name="childPrice"/>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-2 mt-3">Price</h5>
                <div class="col-sm-10"> 
                <input type="text" class="form-control" name="price"/>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-2 mt-3">Member Price</h5>
                <div class="col-sm-10"> 
                <input type="text" class="form-control" name="memberPrice"/>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2 "></div>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Save Schedule</button>
                </div>
            </div>
        </form>
    </div>
    <?php include_once '../inc/scripts.php'; ?>
</body>
</html>