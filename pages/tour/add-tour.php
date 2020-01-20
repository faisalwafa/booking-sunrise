<?php
include_once '../../helper/connection.php';

$tour = $_GET['tour'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../inc/header.php'; ?>
    <title>Tours | Sunrise Indonesia</title>
</head>
<body>
    <div class="container">
        <h4>Tour Detail</h4>
        <form method="post" action="add-tour_action.php">
            <input type="hidden" name="tour_id" value="<?=$tour?>">
            <div class="form-group row">
                <h5 class="col-sm-2 mt-3">Deskripsi</h5>
                <div class="col-sm-10"> 
                <textarea name="deskripsi" class="editor" placeholder="" autofocus ></textarea>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-2 mt-3">Harga Paket</h5>
                <div class="col-sm-10"> 
                <textarea name="harga"class="editor" placeholder="" autofocus></textarea>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-2 mt-3">Detail Itinerary</h5>
                <div class="col-sm-10"> 
                <textarea name="itinerary" class="editor" placeholder="" autofocus></textarea>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-2 mt-3">Harga Termasuk</h5>
                <div class="col-sm-10"> 
                <textarea name="hargaTermasuk" class="editor" placeholder="" autofocus></textarea>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-2 mt-3">Harga Tidak Termasuk</h5>
                <div class="col-sm-10"> 
                <textarea name="hargaTidakTermasuk" class="editor" placeholder="" autofocus></textarea>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-sm-2 mt-3">Force Majeur</h5>
                <div class="col-sm-10"> 
                <textarea name="forceMajeur"class="editor" placeholder="" autofocus></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2 "></div>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <?php include_once '../inc/scripts.php'; ?>
</body>
</html>