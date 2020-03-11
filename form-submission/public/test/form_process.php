<?php
/**
 * Created by PhpStorm.
 * User: Cameron
 * Date: 11/12/2018
 * Time: 9:38 AM
 */

// Insert query here

echo "First Name: ".$_POST['first_name_crew'];
echo "Last Name: ".$_POST['last_name_crew'];
echo "Mobile: ".$_POST['mobile_crew'];
echo "Email: ".$_POST['email_crew'];
echo "First Name: ".$_POST['password_crew'];

$launch_master = (string)$_POST['launch_master'];
echo $launch_master;
echo $_POST['launch_master_card'];
$lines_boat_master_inner = (string)$_POST['lines_boat_master_inner'];
echo $lines_boat_master_inner;
echo $_POST['lines_boat_master_inner_card'];
$lines_boat_master_outer = (string)$_POST['lines_boat_master_outer'];
echo $lines_boat_master_outer;
echo $_POST['lines_boat_master_outer_card'];
$deck_hand_launch = (string)$_POST['deck_hand_launch'];
echo $deck_hand_launch;
echo $_POST['deck_hand_launch_card'];
$deck_hand_lines_boat = (string)$_POST['deck_hand_lines_boat'];
echo $deck_hand_lines_boat;
echo $_POST['deck_hand_lines_boat_card'];
$msic = (string)$_POST['msic'];
echo $msic;
echo $_POST['msic_card'];
$basic_rigger = (string)$_POST['basic_rigger'];
echo $basic_rigger;
echo $_POST['basic_rigger_card'];
$dogman = (string)$_POST['dogman'];
echo $dogman;
echo $_POST['dogman_card'];
$cv_or_cv_crane = (string)$_POST['cv_or_cv_crane'];
echo $cv_or_cv_crane;
echo $_POST['cv_or_cv_crane_card'];

?>

