<?php
/**
 * Created by PhpStorm.
 * User: Cameron
 * Date: 3/12/2018
 * Time: 11:20 AM
 */



if(isset($_POST['submit'])) {
    // 1st Step: checks that there is a valid submission
    echo "<h1>Form processing...</h1><br>";

    /* 2rd Step: Assign form variables to PHP variables
    ** ready to be checked before assigning them to the
    ** MySQL database */
    $imo_number = $_POST['imo_number'];
    $ship_name = $_POST['ship_name'];
    $select_file = $_POST['select_file'];
    $entered_by = $_POST['entered_by'];
    $date_entered = $_POST['date_entered'];
    $time_entered = $_POST['time_entered'];
    $abwa_contacted = $_POST['abwa_contacted'];

    $connection = mysqli_connect('localhost', 'root', '', 'form-submission');

    if($connection) {
        echo "Database connected";
    } else {
        die("DB not connected");
    }

    $query = "INSERT INTO `ship` (`IMO_NUM`, `SHIP_NAME`, `FILE_NAME`, `ENTER_BY`, `DATE_ENTERED`, `TIME_ENTERED`, `CONTACTED_SHIP`) VALUES ('$imo_number', '$ship_name', '$select_file', '$entered_by', '$date_entered', '$time_entered', '$abwa_contacted')";


    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Query failed:');
    };

    echo "<h1>Form submission successful:</h1><br>";


    echo "<p>The Ship IMO Number: " . $imo_number . "</p><br>";
    echo "<p>The Ship Name: " . $ship_name . "</p><br>";
    echo "<p>The path to Ship Image: " . $select_file . "</p><br>";
    echo "<p>Data Entered By: " . $entered_by . "</p><br>";
    echo "<p>The date it was entered: " . $date_entered . "</p><br>";
    echo "<p>The time it was entered: " . $time_entered . "</p><br>";
    echo "<p>Ship Contacted by ABWA? " . $abwa_contacted . "</p><br>";

    // 2nd Step: Check for valid form submission
    /*if(!$imo_number && !$ship_name) {
        // If imo_number and ship_name are not entered
        // properly, display error message

        echo "<h1>Invalid form data detected...<br>please go back and try again</h1>";
    } else {
        echo "<h1>Form submission successful:</h1><br>";


        echo "<p>The Ship IMO Number: " . $imo_number . "</p><br>";
        echo "<p>The Ship Name: " . $ship_name . "</p><br>";
        echo "<p>The path to Ship Image: " . $select_file . "</p><br>";
        echo "<p>Data Entered By: " . $entered_by . "</p><br>";
        echo "<p>The date it was entered: " . $date_entered . "</p><br>";
        echo "<p>The time it was entered: " . $time_entered . "</p><br>";
        echo "<p>Ship Contacted by ABWA? " . $abwa_contacted . "</p><br>";

    };*/


}

?>