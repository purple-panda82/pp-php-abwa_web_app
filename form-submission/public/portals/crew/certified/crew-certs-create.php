<?php
/**
 * Created by PhpStorm.
 * User: Cameron
 * Date: 3/12/2018
 * Time: 11:18 AM
 */
include "../../../../private/db/db_connection.php";
include "../../../../private/db/db_queries.php";

if(isset($_POST['submit-cards'])) {
    addCrewCards();
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Submission</title>

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
        <h1>Add Crew Cards</h1>

    </div>

    <div id="profile" class="card card-def mb-5">
        <div class="card-header blue-bkgrd">
            <h2>Add Certifications</h2>
        </div>
        <div class="card-body">
            <div class="col-12">
                <p>The following form can be used to add all certification associated with your Crew Role</p>
            </div>
                <form class="col-12" action="crew-certs-create.php" method="post">
                    <div class="row">
                        <div class="form-group">
                            <?php retrieveCrewId(); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="launch_master" name="launch_master">
                            <label class="form-check-label" for="launch_master">Launch Master</label>
<!--                            <input class="form-control" type="file" name="launch_master_card" placeholder="Upload Launch Master's Card">-->
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="lines_boat_master_inner" name="lines_boat_master_inner">
                            <label class="form-check-label" for="lines_boat_master_inner">Lines Boat - Inner</label>
<!--                            <input class="form-control" type="file" name="lines_boat_master_inner_card">-->
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="lines_boat_master_outer" name="lines_boat_master_outer">
                            <label class="form-check-label" for="lines_boat_master_outer">Lines Boat - Outer</label>
<!--                            <input class="form-control" type="file" name="lines_boat_master_outer_card">-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="deck_hand_launch" name="deck_hand_launch>
                            <label class="form-check-label" for="deck_hand_launch">Deck Hand - Launch</label>
<!--                            <input class="form-control" type="file" name="deck_hand_launch_card">-->
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="deck_hand_lines_boat" name="deck_hand_lines_boat">
                            <label class="form-check-label" for="deck_hand_lines_boat">Deck Hand - Lines Boat</label>
<!--                            <input class="form-control" type="file" name="deck_hand_lines_boat_card">-->
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="msic_card" name="msic">
                            <label class="form-check-label" for="msic_card">MSIC Card</label>
<!--                            <input class="form-control" type="file" name="msic_card">-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="basic_rigger" name="basic_rigger">
                            <label class="form-check-label" for="basic_rigger">Basic Rigger Card</label>
<!--                            <input class="form-control" type="file" name="basic_rigger_card">-->
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="dogman" name="dogman">
                            <label class="form-check-label" for="dogman">Dogman</label>
<!--                            <input class="form-control" type="file" name="dogman_card">-->
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="cv_or_cv_crane" name="cv_or_cv_crane">
                            <label class="form-check-label" for="cv_or_cv_crane">CV or CV Crane</label>
<!--                            <input class="form-control" type="file" name="cv_or_cv_crane_card">-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-primary btn-lg pl-5 pr-5" type="submit" name="submit-cards">Submit</button>
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
