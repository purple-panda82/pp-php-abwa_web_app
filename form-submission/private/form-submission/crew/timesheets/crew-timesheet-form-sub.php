<?php
/**
 * Created by PhpStorm.
 * User: Cameron
 * Date: 3/12/2018
 * Time: 12:06 PM
 */



if(isset($_POST['submit'])) {
    // 1st Step: checks that there is a valid submission
    echo "<h1>Form processing...</h1><br>";

    /* 2rd Step: Assign form variables to PHP variables
    ** ready to be checked before assigning them to the
    ** MySQL database */
    $first_name_crew = $_POST['first_name_crew'];
    $last_name_crew = $_POST['last_name_crew'];
    $location = $_POST['location'];
    $pay_start = $_POST['pay_start'];
    $pay_end = $_POST['pay_end'];
    $notes_comments = $_POST['notes_comments'];
    $vessel = $_POST['vessel'];
    $crew_role = $_POST['crew_role'];
    $hours = $_POST['hours'];

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
    echo "Surname: " . $last_name_crew;
    echo "Job Location: " . $location;
    echo "Start of Pay Cycle: " . $pay_start;
    echo "End of Pay Cycle: " . $pay_end;
    echo "Notes or Comments: " . $notes_comments;
    echo "Assigned Vessel: " . $vessel;
    echo "Assigned Role: " . $crew_role;
    echo "Number of Hours: " . $hours;
}
?>