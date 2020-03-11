<?php
/**
 * Created by PhpStorm.
 * User: Cameron
 * Date: 3/12/2018
 * Time: 11:18 AM
 */
include "../../../../private/db/db_connection.php";
include "../../../../private/db/db_queries.php";

$id = $_COOKIE['user'];

if(isset($_POST['cargo-delete'])) {
    deleteCargo();
};

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
<div class="container  border border-dark">
    <div class="col-12 aligner mb-3">
        <img src="../../../../images/abwa_logo.png" style="width: 300px;" alt="ABWA Portals">
        <h1>Job Sheet Portal</h1>
    </div>

    <div class="row">
        <div class="col-12 mb-5">
            <h2>View a Job Sheet</h2>
        </div>
        <div class="col-12 mb-5">
            <?php displaySingleJobSheet(); ?> <!-- Display All Job Sheet Information -->
            <?php displayAllCargo(); ?> <!-- Display All Cargo Manifest -->
            <?php displayAllEquipment(); ?> <!-- Display All Equipment Hire -->
            <?php displayAllPersonnel(); ?> <!-- Display All Personnel Hire -->
            <?php displayAllPassenger(); ?> <!-- Display All Passenger Manifest -->
        </div>
        <div class="col-12 mb-5">
            <a type='button' class='btn btn-primary mr-2' href='../../../portals/crew/profile/crew-view.php?id=<?php echo $id;?>'>Back to Profile</a>
        </div>
    </div>

    <footer class="col-12 mb-5">
        <a class="btn btn-primary blue-bkgrd" href="http://www.abwa.com.au/"><h2>ABWA Website</h2></a>
    </footer>
</div>

</body>
</html>
