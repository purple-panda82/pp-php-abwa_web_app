<?php
/**
 * Created by PhpStorm.
 * User: Cameron
 * Date: 3/12/2018
 * Time: 11:34 AM
 */



if(isset($_POST['submit'])) {
// 1st Step: checks that there is a valid submission
    echo "<h1>Form processing...</h1><br>";

    /* 2rd Step: Assign form variables to PHP variables
    ** ready to be checked before assigning them to the
    ** MySQL database */
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $country_code_mob = $_POST['country_code_mob'];
    $mobile = $_POST['mobile'];
    $country_code_ph = $_POST['country_code_ph'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $unit_no = $_POST['unit_no'];
    $street_no = $_POST['street_no'];
    $street_name = $_POST['street_name'];
    $suburb = $_POST['suburb'];
    $locality = $_POST['locality'];
    $state_province = $_POST['state_province'];
    $postcode = $_POST['postcode'];
    $country = $_POST['country'];
    $client_role = $_POST['client_role'];
    $entered_by_client = $_POST['entered_by_client'];
    $date_entered_client = $_POST['date_entered_client'];
    $time_entered_client = $_POST['time_entered_client'];

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


    echo "<p>The Ship IMO Number: " . $imo_number . "</p><br>";
    echo "<p>The Ship Name: " . $ship_name . "</p><br>";
    echo "<p>The path to Ship Image: " . $select_file . "</p><br>";
    echo "<p>Data Entered By: " . $entered_by . "</p><br>";
    echo "<p>The date it was entered: " . $date_entered . "</p><br>";
    echo "<p>The time it was entered: " . $time_entered . "</p><br>";
    echo "<p>Ship Contacted by ABWA? " . $abwa_contacted . "</p><br>";

    echo "Client First Name: " . $first_name;
    echo "Client Last Name: " . $last_name;
    echo "Mobile Country Code: " . $country_code_mob;
    echo "Mobile: " . $mobile;
    echo "Office Phone Country Code: " . $country_code_ph;
    echo "Office Phone: " . $phone;
    echo "Email: " . $email;
    echo "Unit No# " . $unit_no;
    echo "Street No# " . $street_no;
    echo "Street Name: " . $street_name;
    echo "Suburb: " . $suburb;
    echo "Locality: " . $locality;
    echo "State/Province: " . $state_province;
    echo "Postcode: " . $postcode;
    echo "Country: " . $country;
    echo "Client Role: " . $client_role;
    echo "Entered By: " . $entered_by_client;
    echo "Date Entered: " . $date_entered_client;
    echo "Time Entered: " . $time_entered_client;
}

?>
