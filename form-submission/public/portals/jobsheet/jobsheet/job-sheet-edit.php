<?php
/**
 * Created by PhpStorm.
 * User: Cameron
 * Date: 3/12/2018
 * Time: 11:18 AM
 */
include "../../../../private/db/db_connection.php";
include "../../../../private/db/db_queries.php";

if(isset($_POST['edit-jobsheet'])) {
    saveEditJobSheet();
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Sheet</title>

    <link rel="stylesheet" href="../../../../styles/bootstrap-reboot.css">
    <link rel="stylesheet" href="../../../../styles/bootstrap-grid.css">
    <link rel="stylesheet" href="../../../../styles/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../../styles.css">
</head>
<body>
<div class="container">
    <div class="col-12 aligner mb-3">
        <img src="../../../../images/abwa_logo.png" style="width: 300px;" alt="ABWA Portals">
        <h1>Job Sheet</h1>
    </div>

    <div id="profile" class="card card-def mb-5">
        <div class="card-header blue-bkgrd">
            <h2>Edit Job Sheet</h2>
        </div>
        <div class="card-body">
            <div class="col-12">
                <p>To edit Job Sheet, please input the new details in the required form below</p>
            </div>
            <?php editJobSheetView(); ?>
        </div>
    </div>

    <footer class="col-12 mt-5">
        <a class="btn btn-primary blue-bkgrd" href="http://www.abwa.com.au/"><h2>ABWA Website</h2></a>
    </footer>
</div>
</body>
</html>
