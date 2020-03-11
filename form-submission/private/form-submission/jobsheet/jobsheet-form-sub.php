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
    $created_by = $_POST['created_by'];
    $approved_by = $_POST['approved_by'];
    $issued_by = $_POST['issued_by'];
    $revision_no = $_POST['revision_no'];
    $issed_date = $_POST['issed_date'];
    $abwa_job_no = $_POST['abwa_job_no'];
    $job_date = $_POST['job_date'];
    $start_time_job = $_POST['start_time_job'];
    $end_time_job = $_POST['end_time_job'];
    $port_of_origin = $_POST['port_of_origin'];
    $vessel_job = $_POST['vessel_job'];
    $assigned_master = $_POST['assigned_master'];
    $assigned_crew1 = $_POST['assigned_crew1'];
    $assigned_crew2 = $_POST['assigned_crew2'];
    $attending = $_POST['attending'];
    $attending_ship_name = $_POST['attending_ship_name'];
    $outer_port_limit = $_POST['outer_port_limit'];
    $inner_port = $_POST['inner_port'];
    $outer_port = $_POST['outer_port'];
    $anchorage = $_POST['anchorage'];
    $berth_anchorage = $_POST['berth_anchorage'];
    $transfer = $_POST['transfer'];
    $lines_boat = $_POST['lines_boat'];
    $drill = $_POST['drill'];
    $berth = $_POST['berth'];
    $berth_hours = $_POST['berth_hours'];
    $berth_days = $_POST['berth_days'];
    $mooring = $_POST['mooring'];
    $mooring_hours = $_POST['mooring_hours'];
    $mooring_days = $_POST['mooring_days'];
    $crane = $_POST['crane'];
    $crane_hours = $_POST['crane_hours'];
    $crane_days = $_POST['crane_days'];
    $truck = $_POST['truck'];
    $truck_hours = $_POST['truck_hours'];
    $truck_days = $_POST['truck_days'];
    $fender = $_POST['fender'];
    $fender_hours = $_POST['fender_hours'];
    $fender_days = $_POST['fender_days'];
    $utility = $_POST['utility'];
    $utility_hours = $_POST['utility_hours'];
    $utility_days = $_POST['utility_days'];
    $other = $_POST['other'];
    $other_hours = $_POST['other_hours'];
    $others_days = $_POST['others_days'];
    $fab_welder = $_POST['fab_welder'];
    $fab_welder_hours = $_POST['fab_welder_hours'];
    $fab_welder_days = $_POST['fab_welder_days'];
    $naval_arch = $_POST['naval_arch'];
    $naval_arch_hours = $_POST['naval_arch_hours'];
    $naval_arch_days = $_POST['naval_arch_days'];
    $gp_labour_security = $_POST['gp_labour_security'];
    $gp_labour_security_hours = $_POST['gp_labour_security_hours'];
    $gp_labour_security_days = $_POST['gp_labour_security_days'];
    $ship_wright = $_POST['ship_wright'];
    $ship_wright_hours = $_POST['ship_wright_hours'];
    $ship_wright_days = $_POST['ship_wright_days'];
    $carpenter = $_POST['carpenter'];
    $carpenter_hours = $_POST['carpenter_hours'];
    $carpenter_days = $_POST['carpenter_days'];
    $notes_comments = $_POST['notes_comments'];
    $pax = $_POST['pax'];
    $initial = $_POST['initial'];
    $surname = $_POST['surname'];

//    $connection = mysqli_connect('localhost', 'root', '', 'form-submission');
//
//    if($connection) {
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
//    if(!$result) {
//        die('Query failed:');
//    };

    echo "<h1>Form submission successful:</h1><br>";

    echo "Created by: " . $created_by;
    echo "Approved by: " . $approved_by;
    echo "Issued by: " . $issued_by;
    echo "Revision No#" . $revision_no;
    echo "Issued Date: " . $issed_date;
    echo "ABWA Job No#" . $abwa_job_no;
    echo "Job Date: " . $job_date;
    echo "Start Time: " . $start_time_job;
    echo "End Time: " . $end_time_job;
    echo "Port of Origin: " . $port_of_origin;
    echo "Vessel: " . $vessel_job;
    echo "Assigned Master: " . $assigned_master;
    echo "Assigned Crew: " . $assigned_crew1;
    echo "Assigned Crew:" . $assigned_crew2;
    echo "Attending: " . $attending;
    echo "Attending Ship Name: " . $attending_ship_name;
    echo "Outer Port Limit: " . $outer_port_limit;
    echo "Inner Port: " . $inner_port;
    echo "Outer Port: " . $outer_port;
    echo "Anchorage: " . $anchorage;
    echo "Berth or Anchorage: " . $berth_anchorage;
    echo "Transfer" . $transfer;
    echo "Lines Boat: " . $lines_boat;
    echo "Drill: " . $drill;
    echo "Berth: " . $berth;
    echo "Berth Hours: " . $berth_hours;
    echo "Berth Days: " . $berth_days;
    echo "Mooring: " . $mooring;
    echo "Mooring Hours: " . $mooring_hours;
    echo "Mooring Days: " . $mooring_days;
    echo "Crane: " . $crane;
    echo "Crane Hours: " . $crane_hours;
    echo "Crane Days: " . $crane_days;
    echo "Truck: " . $truck;
    echo "Truck Hours: " . $truck_hours;
    echo "Truck Days: " . $truck_days;
    echo "Fender: " . $fender;
    echo "Fender Hours: " . $fender_hours;
    echo "Fender Days: " . $fender_days;
    echo "Utility: " . $utility;
    echo "Utility Hours: " . $utility_hours;
    echo "Utility Days: " . $utility_days;
    echo "Other: " . $other;
    echo "Other Hours: " . $other_hours;
    echo "Others Days: " . $others_days;
    echo "Fabrication/Welding: " . $fab_welder;
    echo "Fabrication/Welding Hours: " . $fab_welder_hours;
    echo "Fabrication/Wleding Days: " . $fab_welder_days;
    echo "Naval Architecture: " . $naval_arch;
    echo "Naval Architecture Hours: " . $naval_arch_hours;
    echo "Navel Architecture Days: " . $naval_arch_days;
    echo "GP Labour / Security: " . $gp_labour_security;
    echo "GP Labour / Security Hours: " . $gp_labour_security_hours;
    echo "GP Labour / Security Days: " . $gp_labour_security_days;
    echo "Ship Wright: " . $ship_wright;
    echo "Ship Wright Hours: " . $ship_wright_hours;
    echo "Ship Wright Days: " . $ship_wright_days;
    echo "Carpenter: " . $carpenter;
    echo "Carpenter Hours: " . $carpenter_hours;
    echo "Carpenter Days: " . $carpenter_days;
    echo "Notes and Comments: " . $notes_comments;
    echo "PAX: " . $pax;
    echo "Initial: " . $initial;
    echo "Surname: " . $surname;
}
?>