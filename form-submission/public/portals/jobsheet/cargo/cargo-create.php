<?php
/**
 * Created by PhpStorm.
 * User: Cameron
 * Date: 3/12/2018
 * Time: 11:18 AM
 */
include "../../../../private/db/db_connection.php";
include "../../../../private/db/db_queries.php";

if(isset($_POST['add-cargo'])) {
    addCargo();
}

if(isset($_POST['go-to-job-view'])) {
    goBackToJob();
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Sheet Portal</title>

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
        <h1>Job Sheet Portal</h1>

    </div>

    <div id="profile" class="card card-def mb-5">
        <div class="card-header blue-bkgrd">
            <h2>Add Cargo Manifest</h2>
        </div>
        <div class="card-body">
            <div class="col-12">
                <p>The following form can be used to add all certification associated with your Crew Role</p>
            </div>
            <form class="col-12" action="cargo-create.php" method="post">
                <div class="row">
                    <div class="form-group">
                        <?php retrieveJobId(); ?>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-3">
                        <label for="qty">QTY</label>
                        <input type="number" class="form-control" name="qty" id="qty">
                    </div>
                    <div class="col-3">
                        <label for="item">Item: </label>
                        <input type="text" class="form-control" name="item" id="item">
                    </div>
                    <div class="col-3">
                        <label for="del_to">Delivered To:</label>
                        <input type="text" class="form-control form-check" name="del_to" id="del_to">
<!--                        <label for="platform" class="form-check-label">Facility</label>-->
<!--                        <input type="checkbox" class="form-control form-check" name="del_to" id="platform">-->
<!--                        <label for="ship" class="form-check-label">Facility</label>-->
<!--                        <input type="checkbox" class="form-control form-check" name="del_to" id="ship">-->
                    </div>
                    <div class="col-3">
                        <label for="voyage">Voyage:</label>
                        <input type="text" class="form-control" name="voyage" id="voyage">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-primary btn-lg pl-5 pr-5" type="submit" name="add-cargo">Add</button>
                        <button class="btn btn-primary btn-lg pl-5 pr-5" type="submit" name="go-to-job-view">Return to Job Sheet</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <footer class="col-12 mt-5">
        <a class="btn btn-primary blue-bkgrd" href="../../../../index.php"><h2>Dashboard</h2></a>
        <a class="btn btn-primary blue-bkgrd" href="http://www.abwa.com.au/"><h2>ABWA Website</h2></a>
    </footer>
</div>
</body>
</html>
