<?php
/**
 * Created by PhpStorm.
 * User: Cameron
 * Date: 3/12/2018
 * Time: 11:18 AM
 */
include "../../../../private/db/db_connection.php";
include "../../../../private/db/db_queries.php";

//if(isset($_POST['submit-profile'])) {
//    createNewCrew();
//}


?>


<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Your Certifications</title>

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
        <h1>Update Crew Cards</h1>

    </div>

    <div id="profile" class="card card-def mb-5">
        <div class="card-header blue-bkgrd">
            <h2>Create a New Profile</h2>
        </div>
        <div class="card-body">
            <div class="col-12">
                <p>Use the following form to update your cards to your profile.</p>
            </div>
            <form class="col-12" action="../profile/crew-create.php" method="post">
                <div class="row">
                    <div class="col-4 form-group">
                        <label class="form-control"><?php $_POST['first_name_crew']; ?></label>
                    </div>
                    <div class="col-4 form-group">
                        <label class="form-control"><?php $_POST['last_name_crew']; ?></label>
                    </div>
                    <div class="col-4 form-group">
                        <input class="form-control" type="text" name="mobile_crew" placeholder="Mobile*">
                    </div>
                </div>
                <div class="row">
                    <div class="col-8 form-group">
                        <input class="form-control" type="email" name="email_crew" placeholder="example@mail.com*" value="example@mail.com">
                    </div>
                    <div class="col-4 form-group">
                        <input class="form-control" type="password" name="password_crew" placeholder="Password*">
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-primary btn-lg pl-5 pr-5" type="submit" name="submit-profile">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>-->
    <!--<div id="availability" class="card card-def mb-5">
        <div class="card-header blue-bkgrd">
            <h2>Add Availability</h2>
        </div>
        <div class="card-body">
            <div class="col-12">
                <p>Please insert all your availability. For availability across whole day, check the All Day box. For specific periods of non-availability, please enter times in the appropriate fields.</p>
            </div>
            <form class="col-12">
                <div class="row mb-3">
                    <div style="width:42.8571428px; min-height:420px; background-color: red;">Mon</div>
                    <div style="width:42.8571428px; min-height:420px; background-color: blue;">Tues</div>
                    <div style="width:42.8571428px; min-height:420px; background-color: green;">Wed</div>
                    <div style="width:42.8571428px; min-height:420px; background-color: yellow;">Thur</div>
                    <div style="width:42.8571428px; min-height:420px; background-color: purple;">Fri</div>
                    <div style="width:42.8571428px; min-height:420px; background-color: orange;">Sat</div>
                    <div style="width:42.8571428px; min-height:420px; background-color: grey;">Sun</div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-primary btn-lg pl-5 pr-5" type="submit-cards">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div> -->
    <!--<div id="card-upload" class="card card-def mb-5">
        <div class="card-header blue-bkgrd">
            <h2>Crew's Cards</h2>
        </div>
        <div class="card-body">
            <div class="col-12">
                <p>Please select each card that you current hold, as well as uploading a .pdf version of it. Any issues, please contact ABWA Admin on 'their phone number'.</p>
            </div>
            <form class="col-12" action="crew-create.php" method="post">
                <div class="row">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="launch_master" name="launch_master">
                        <label class="form-check-label" for="launch_master">Launch Master</label>
                        <input class="form-control" type="file" name="launch_master_card" placeholder="Upload Launch Master's Card">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="lines_boat_master_inner" name="lines_boat_master_inner">
                        <label class="form-check-label" for="lines_boat_master_inner">Lines Boat - Inner</label>
                        <input class="form-control" type="file" name="lines_boat_master_inner_card">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="lines_boat_master_outer" name="lines_boat_master_outer">
                        <label class="form-check-label" for="lines_boat_master_outer">Lines Boat - Outer</label>
                        <input class="form-control" type="file" name="lines_boat_master_outer_card">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="deck_hand_launch" name="deck_hand_launch>
                        <label class="form-check-label" for="deck_hand_launch">Deck Hand - Launch</label>
                        <input class="form-control" type="file" name="deck_hand_launch_card">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="deck_hand_lines_boat" name="deck_hand_lines_boat">
                        <label class="form-check-label" for="deck_hand_lines_boat">Deck Hand - Lines Boat</label>
                        <input class="form-control" type="file" name="deck_hand_lines_boat_card">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="msic_card" name="msic">
                        <label class="form-check-label" for="msic_card">MSIC Card</label>
                        <input class="form-control" type="file" name="msic_card">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="basic_rigger" name="basic_rigger">
                        <label class="form-check-label" for="basic_rigger">Basic Rigger Card</label>
                        <input class="form-control" type="file" name="basic_rigger_card">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="dogman" name="dogman">
                        <label class="form-check-label" for="dogman">Dogman</label>
                        <input class="form-control" type="file" name="dogman_card">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="cv_or_cv_crane" name="cv_or_cv_crane">
                        <label class="form-check-label" for="cv_or_cv_crane">CV or CV Crane</label>
                        <input class="form-control" type="file" name="cv_or_cv_crane_card">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-primary btn-lg pl-5 pr-5" type="submit" name="submit-cards">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>-->

    <footer class="col-12 mt-5">
        <a class="btn btn-primary blue-bkgrd" href="../../../../index.php"><h2>Dashboard</h2></a>
        <a class="btn btn-primary blue-bkgrd" href="http://www.abwa.com.au/"><h2>ABWA Website</h2></a>
    </footer>
</div>
</body>
</html>
