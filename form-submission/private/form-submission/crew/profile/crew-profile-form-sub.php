<?php
/**
 * Created by PhpStorm.
 * User: Cameron
 * Date: 3/12/2018
 * Time: 12:05 PM
 */



if(isset($_POST['submit'])) {
    // 1st Step: checks that there is a valid submission
    echo "<h1>Form processing...</h1><br>";

    /* 2rd Step: Assign form variables to PHP variables
    ** ready to be checked before assigning them to the
    ** MySQL database */

    $first_name_crew = $_POST['first_name_crew'];
    $last_name_crew = $_POST['last_name_crew'];
    $crew_mobile = $_POST['crew_mobile'];
    $crew_email = $_POST['crew_email'];
    $launch_master = $_POST['launch_master'];
    $lines_boat_master_inner = $_POST['lines_boat_master_inner'];
    $lines_boat_master_outer = $_POST['lines_boat_master_outer'];
    $deck_hand_launch = $_POST['deck_hand_launch'];
    $deck_hand_lines_boat = $_POST['deck_hand_lines_boat'];
    $msic_card = $_POST['msic_card'];
    $basic_rigger = $_POST['basic_rigger'];
    $dogman = $_POST['dogman'];
    $cv_or_cv_crane = $_POST['cv_or_cv_crane'];

//    $connection = mysqli_connect('localhost', 'root', '', 'form-submission');
//
//    if ($connection) {
//        echo "Database connected";
//    } else {
//        die("DB not connected");
//    }
//
//    $query = "INSERT INTO `ship` (`IMO_NUM`, `SHIP_NAME`, `FILE_NAME`, `ENTER_BY`, `DATE_ENTERED`, `TIME_ENTERED`, `CONTACTED_SHIP`) VALUES ('$imo_number', '$ship_name', '$select_file', '$entered_by', '$date_entered', '$time_entered', '$abwa_contacted')";
//
//
//    $result = mysqli_query($connection, $query);
//
//    if (!$result) {
//        die('Query failed:');
//    };

    echo "<h1>Form submission successful:</h1><br>";


    echo "First Name: " . $first_name_crew;
    echo "Last Name: " . $last_name_crew;
    echo "Mobile: " . $crew_mobile;
    echo "Email: " . $crew_email;
    echo "Launch Master: " . ($launch_master);
    echo "Lines Boat Master - Inner Habour: " . ($lines_boat_master_inner);
    echo "Lines Boat Master - Outer Habour: " . ($lines_boat_master_outer);
    echo "Deck Hand - Launch: " . ($deck_hand_launch);
    echo "Deck Hand - Lines Boat: " . ($deck_hand_lines_boat);
    echo "MSIC Card: " . ($msic_card);
    echo "Basic Rigger: " . ($basic_rigger);
    echo "Dogman: " . ($dogman);
    echo "CV or CV Crane: " . ($cv_or_cv_crane);
}