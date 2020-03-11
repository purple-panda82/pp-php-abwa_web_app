<?php
/**
 * Created by PhpStorm.
 * User: Cameron Yandell
 * Purpose: The following PHP file is used to handle all database queries
 * as a single re-usable source. It is broken into different sections:
 * -- CREW PROFILE QUERIES
 * -- CREW AVAILABILITY QUERIES
 * -- CREW CERTS QUERIES
 * -- CREW SHIFTS QUERIES
 * -- CREW TIME SHEETS QUERIES
*/

include "db_connection.php"; // Connection to the MySQL Database

/** -- LOGIN QUERY */

function loginValidate() {
    global $connection;

    $username = $_POST['email_crew'];
    $password = $_POST['password_crew'];

    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;
    };

    $query = "SELECT * FROM `crew` WHERE `crew`.`email_crew` = '$username'";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            die('Query failed:' . mysqli_error($connection));
        };

        $login = mysqli_fetch_assoc($result);

        if($password == $login['password_crew']) {
            $cookie_name = "user";
            $cookie_value = $login['id'];
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            header("Location:portals/crew/profile/crew-view.php?id=".$login['id']."");
            exit();
        }
}

function getCrewEmails() {
    global $connection;


    $query = "SELECT * FROM `crew` WHERE 1";

    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Query failed:' . mysqli_error($connection));
    };


    $to = "camerongyandell82@gmail.com";
    $subject = "Shifts Available";
    $message = "Please log into your Crew Portal to accept new shifts.<br><a href='http://www.abwa.com.au/app/index.php'>Access Crew Portal</a>";
    $header = "From: hello@cameronyandell.com.au\r\n";
    while($emails = mysqli_fetch_assoc($result)){
    $header .= "Cc: ".$emails['email_crew']. ", \r\n";
    };
    $header .="MIME-Version: 1.0\r\n";
    $header .="Content-type: text/html\r\n";
    $retval = mail($to, $subject, $message, $header);
    if($retval == true){
        echo "Message sent successfully...";
    } else {
        echo "Message could not be sent...";
    }

    $crew_id = $_COOKIE['user'];

    if($result) {
        header("Location:../../public/portals/crew/profile/crew-view.php?id=$crew_id");
        exit();
    }


}

    // Define variables and initialize with empty values
//     $username = "";
//     $password = "";
//     $username_err = "";
//     $password_err = "";
//
//     // Processing form data when form is submitted
//if($_SERVER["REQUEST_METHOD"] == "POST"){
//    // Check if username is empty
//    if(empty(trim($_POST["username"]))){
//        $username_err = "Please enter username.";
//    } else {
//        $username = trim($_POST["email_crew"]);
//    }
//
//    // Check if password is empty
//    if(empty(trim($_POST["password"]))) {
//        $password_err = "Please enter your password.";
//    } else {
//        $password = trim($_POST["password_crew"]);
//    }
//
//    // Validate credentials
//    if(empty($username_err) && empty($password_err)) {
//        // Prepare a select statement
//        $sql = "SELECT * FROM crew";
//
//        $result = mysqli_query($connection, $sql);
//
//        if(!$result) {
//            die('Query failed:' . mysqli_error($connection));
//        };
//
//        if($username == $result['email_crew'] && $password == $result['password_crew']) {
//            $_SESSION['id'] = $result['id'];
//            $_SESSION['loggedIn'] = true;
//            header("Location:portals/crew/profile/crew-view.php?id=".$result['id']."");
//            exit();
//        }


//        if($stmt = mysqli_prepare($link, $sql)){
//            // Bind variables to the prepared statement as parameters
//            mysqli_stmt_bind_param($stmt, "s", $param_username);
//            // Set parameters
//            $param_username = $username;
//            // Attempt to execute the prepared statement
//                if(mysqli_stmt_execute($stmt)){
//                    // Store result
//                    mysqli_stmt_store_result($stmt);
//                    // Check if username exists, if yes then verify password
//                if(mysqli_stmt_num_rows($stmt) == 1) {
//                    // Bind result variables
//                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
//                        if(mysqli_stmt_fetch($stmt)) {
//                            if(password_verify($password, $hashed_password)) {
//                                // Password is correct, so start a new session
//                                session_start();
//                                // Store data in session variables
//                                $_SESSION["loggedin"] = true;
//                                $_SESSION["id"] = $id;
//                                $_SESSION["username"] = $username;
//
//                                // Redirect user to welcome page
//                                header("location: welcome.php");
//                            } else {
//                                // Display an error message if password is not valid
//                                $password_err = "The password you entered was not valid.";
//                            }
//                        }
//                } else {
//                    // Display an error message if username doesn't exist
//                    $username_err = "No account found with that username.";
//                }
//            } else {
//                echo "Oops! Something went wrong. Please try again later.";
//            }
//        }
        // Close statement
//        mysqli_stmt_close($stmt);
//    }
//    // Close connection
//    mysqli_close($link);
//    }
//}

/** -- CREW PROFILE QUERIES */

// Create a new Crew Profile and inputs it into the database
// For Availability and Crew Cert's please see:
// Availability: CREW AVAILABILITY
// Crew Cert's: CREW CERTS
// Both of which are below
function createNewCrew() {
    global $connection;

    $first_name_crew = $_POST['first_name_crew'];
    $last_name_crew = $_POST['last_name_crew'];
    $mobile_crew = $_POST['mobile_crew'];
    $email_crew = $_POST['email_crew'];
    $password_crew = $_POST['password_crew'];
    $isAdmin = 'NO';
    $isMaster = 'NO';
    $normal = 'YES';



    $query = "INSERT INTO `crew` (`id`, `first_name_crew`, `last_name_crew`, `mobile_crew`, `email_crew`, `password_crew`, `isAdmin`, `isMaster`, `normal`, `archive_crew`) VALUES (NULL, '$first_name_crew', '$last_name_crew', '$mobile_crew', '$email_crew', '$password_crew', '$isAdmin', '$isMaster', '$normal', NULL);";


    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    if($result) {
        header("Location:login.php");
        exit();
    }
}

// Get All Crew profiles for table list view
function displayAllCrew() {
    global $connection;
    $query = "SELECT * FROM crew WHERE 1";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Query failed:');
    };

    echo "<table class=\"table table-hover\">";
        echo "<thead>";
            echo "<tr>";
                echo "<th scope=\"col\">#</th>";
                echo "<th scope=\"col\">First Name</th>";
                echo "<th scope=\"col\">Last Name</th>";
                echo "<th scope=\"col\">Mobile</th>";
                echo "<th scope=\"col\">Email</th>";
                echo "<th scope=\"col\">Actions</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['first_name_crew'] . "</td>";
                echo "<td>" . $row['last_name_crew'] . "</td>";
                echo "<td>" . $row['mobile_crew'] . "</td>";
                echo "<td>" . $row['email_crew'] . "</td>";
                echo "<td>";
                echo "<a type='button' class='btn btn-primary mr-2' href=\"crew-view.php?id=" . $row['id'] . ".\">View</a>";
                echo "<a type='button' class='btn btn-primary mr-2' href=\"crew-update.php?id=" . $row['id'] . ".\">Edit</a>";
                echo "<a type='button' class='btn btn-danger' href=\"crew-archive.php?id=" . $row['id'] . ".\">Delete</a>";
                echo "</td>";
            echo "</tr>";
        };
        echo "</tbody>";
    echo "</table>";



}

// Get All Crew profiles for table list view
function displayAllCrewAsList() {
    global $connection;
    $query = "SELECT * FROM crew WHERE 1";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Query failed:');
    };


    echo "<select id='vessel' class='form-control form-control-sm' name='master'>";
    while($master = mysqli_fetch_assoc($result)) {
        echo "<option value='".$master['id']."'>".$master['first_name_crew']." ".$master['last_name_crew']."</option>";
    }
    echo "</select>";



}

// Get and display all Crew data for complete list display
function displaySingleCrewData() {
    global $connection;

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM `crew` WHERE `crew`.`id` = '$id'";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Query failed:' . mysqli_error($connection));
        };

        $crew = mysqli_fetch_assoc($result);

        echo "<div class='card-header blue-bkgrd'>";
            echo "<h2>" . $crew['id'] . " " . $crew['first_name_crew'] . " " . $crew['last_name_crew'] . "</h2>";
        echo "</div>";

        echo "<div class='card-body'>";
            echo "<div class='row'>";
                echo "<div class='col-6'>";
                    echo "<p class='card-text' style='font-size: 1.5rem;'>Mobile: " . $crew['mobile_crew'] ."</p>";
                echo "</div>";
                echo "<div class='col-6'>";
                    echo "<p class='card-text' style='font-size: 1.5rem;'>Email: " . $crew['email_crew'] ."</p>";
                echo "</div>";
            echo "</div>";
        echo "</div>";

    }
}

// Get and display all Crew data for complete list display
function getSingleCrew() {
    global $connection;

    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $query = "SELECT * FROM `crew` WHERE `crew`.`id` = '$id'";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Query failed:' . mysqli_error($connection));
        };

        $crew = mysqli_fetch_assoc($result);

        echo "<form class=\"col-12\" action=\"crew-update.php\" method=\"post\">";
        echo "<div class='row'>";
        echo "<input class=\"form-control\" type=\"text\" name=\"id\" value=\"" . $crew['id'] . "\">";
        echo "</div>";
        echo "<div class=\"row\">";
        echo "<div class=\"col-4 form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"first_name_crew\" value=\"" . $crew['first_name_crew'] . "\">";
        echo "</div>";
        echo "<div class=\"col-4 form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"last_name_crew\" value=\"" . $crew['last_name_crew'] . "\">";
        echo "</div>";
        echo "<div class=\"col-4 form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"mobile_crew\" value=\"" . $crew['mobile_crew'] . "\">";
        echo "</div>";
        echo "</div>";
        echo "<div class=\"row\">";
        echo "<div class=\"col-8 form-group\">";
        echo "<input class=\"form-control\" type=\"email\" name=\"email_crew\" value=\"" . $crew['email_crew'] . "\" value=\"" . $crew['email_crew'] . "\">";
        echo "</div>";
        echo "<div class=\"col-4 form-group\">";
        echo "<input class=\"form-control\" type=\"password\" name=\"password_crew\" value=\"" . $crew['password_crew'] . "\">";
        echo "</div>";
        echo "</div>";
        echo "<div class=\"row\">";
        echo "<div class=\"col-6\">";
        echo "<button class=\"btn btn-primary btn-lg pl-5 pr-5\" type=\"submit\" name=\"update_profile\">Save Changes</button>";
        echo "</div>";
        echo "</div>";
        echo "</form>";
    }
}

// Edit the specific Crew details
function editSingleCrewData() {
    global $connection;

    $id = $_POST['id'];
    $first_name_crew = $_POST['first_name_crew'];
    $last_name_crew = $_POST['last_name_crew'];
    $mobile_crew = $_POST['mobile_crew'];
    $email_crew = $_POST['email_crew'];
    $password_crew = $_POST['password_crew'];


    $query = "UPDATE `crew` SET `first_name_crew` = '$first_name_crew', `last_name_crew` = '$last_name_crew', `mobile_crew` = '$mobile_crew', `email_crew` = '$email_crew', `password_crew` = '$password_crew' WHERE `crew`.`id` = '$id';";

    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Query failed:' . mysqli_error($connection));
    };
}

// Get and display all Crew data for complete list display
function getSingleCrewForDelete() {
    global $connection;

    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $query = "SELECT * FROM `crew` WHERE `crew`.`id` = '$id'";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Query failed:' . mysqli_error($connection));
        };

        $crew = mysqli_fetch_assoc($result);

        echo "<form class=\"col-12\" action=\"crew-archive.php\" method=\"post\">";
        echo "<div class='row'>";
        echo "<input class=\"form-control\" type=\"text\" name=\"id\" value=\"" . $crew['id'] . "\">";
        echo "</div>";
        echo "<div class=\"row\">";
        echo "<div class=\"col-4 form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"first_name_crew\" value=\"" . $crew['first_name_crew'] . "\">";
        echo "</div>";
        echo "<div class=\"col-4 form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"last_name_crew\" value=\"" . $crew['last_name_crew'] . "\">";
        echo "</div>";
        echo "<div class=\"col-4 form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"mobile_crew\" value=\"" . $crew['mobile_crew'] . "\">";
        echo "</div>";
        echo "</div>";
        echo "<div class=\"row\">";
        echo "<div class=\"col-8 form-group\">";
        echo "<input class=\"form-control\" type=\"email\" name=\"email_crew\" value=\"" . $crew['email_crew'] . "\" value=\"" . $crew['email_crew'] . "\">";
        echo "</div>";
        echo "<div class=\"col-4 form-group\">";
        echo "<input class=\"form-control\" type=\"password\" name=\"password_crew\" value=\"" . $crew['password_crew'] . "\">";
        echo "</div>";
        echo "</div>";
        echo "<div class=\"row\">";
        echo "<div class=\"col-6\">";
        echo "<button class=\"btn btn-primary btn-lg pl-5 pr-5\" type=\"submit\" name=\"archive_profile\">Confirm</button>";
        echo "</div>";
        echo "</div>";
        echo "</form>";
    }
}

// Delete a Crew from the database
function deleteCrewData() {
    global $connection;

    $id = $_POST['id'];


    $query = "DELETE FROM `crew` WHERE `crew`.`id` = '$id';";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    if($result) {
        header("Location:../../../../index.php");
        exit();
    }

}

// Retrieve Crew Id for future use
function retrieveCrewId() {
    global $connection;

    $crew = null;

    $retrieve = "SELECT * FROM crew ORDER by id DESC LIMIT 1;";

    $singleCrew = mysqli_query($connection, $retrieve);

    if(!$singleCrew) {
        die('Query failed:' . mysqli_error($connection));
    };

    $crew = mysqli_fetch_assoc($singleCrew);

    echo "<input type='text' class='form-control' name='crew_id' value='".$crew['id']."'>";
}

// Display Job Sheet Actions based on Crew Authority
function displayShipEntry() {
    global $connection;

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM `crew` WHERE `crew`.`id` = '$id'";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Query failed:' . mysqli_error($connection));
        };

        $crew = mysqli_fetch_assoc($result);

        if($crew['isAdmin'] == 'YES') {

        echo "<div class=\"row\">";
            echo "<div class=\"col-sm-12 col-lg-6\">";
            echo "<a href=\"../../ship/ship-create.php\" class=\"btn btn-primary blue-bkgrd col-12 mt-3 mb-1\">";
            echo "<i class=\"fas fa-plus-circle mr-3\"></i> <span>Create New Ship</span></i>";
            echo "</a>";
            echo "</div>";
            echo "<div class=\"col-sm-12 col-lg-6\">";
            echo "<a href=\"../../ship/ship-view-all.php\" class=\"btn btn-primary blue-bkgrd col-12 mt-3 mb-1\">";
            echo "<i class=\"far fa-eye mr-3\"></i> <span>View All Ships</span>";
            echo "</a>";
            echo "</div>";
        echo "</div>";
        echo "<hr>";

        echo "<div class=\"row\">";
            echo "<div class=\"col-sm-12 col-lg-6\">";
            echo "<a href=\"../../agents/agent-create.php\" class=\"btn btn-primary blue-bkgrd col-12 mt-3 mb-1\">";
            echo "<i class=\"fas fa-plus-circle mr-3\"></i> <span>Create New Agent</span></i>";
            echo "</a>";
            echo "</div>";
            echo "<div class=\"col-sm-12 col-lg-6\">";
        echo "<a href=\"../../agents/agent-view-all.php\" class=\"btn btn-primary blue-bkgrd col-12 mt-3 mb-1\">";
        echo "<i class=\"far fa-eye mr-3\"></i> <span>View All Agents</span></i>";
        echo "</a>";
        echo "</div>";
        echo "</div>";
        };
    }
}

// Display Job Sheet Actions based on Crew Authority
function displayJobSheets() {
    global $connection;

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM `crew` WHERE `crew`.`id` = '$id'";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Query failed:' . mysqli_error($connection));
        };

        $crew = mysqli_fetch_assoc($result);

        if($crew['isMaster'] == 'YES') {
            echo "<div class=\"row\">";
            echo "<div class=\"col-sm-12 col-lg-6\">";
            echo "<a href=\"../../jobsheet/jobsheet/job-sheet-create.php\" class=\"btn btn-primary blue-bkgrd col-12 mt-3 mb-1\">";
            echo "<i class=\"fas fa-plus-circle mr-3\"></i> <span>Create New Job Sheet</span></i>";
            echo "</a>";
            echo "</div>";
            echo "<div class=\"col-sm-12 col-lg-6\">";
            echo "<a href=\"../../../../private/includes/crew-call.php\" class=\"btn btn-primary blue-bkgrd col-12 mt-3 mb-1\">";
            echo "<i class=\"fas fa-plus-circle mr-3\"></i> <span>Send Crew Call</span>";
            echo "</a>";
            echo "</div>";
            echo "</div>";
            echo "<hr>";

            echo "<div class=\"row\">";
            echo "<div class=\"col-sm-12 col-lg-6\">";
            echo "<a href=\"../../jobsheet/jobsheet/job-sheet-view-all.php\" class=\"btn btn-primary blue-bkgrd col-12 mt-3 mb-1\">";
            echo "<i class=\"far fa-eye mr-3\"></i> <span>View All Job Sheets</span></i>";
            echo "</a>";
            echo "</div>";
            echo "</div>";
        }
    }
}

/** -- CREW AVAILABILITY QUERIES */

/** -- CREW CERTS QUERIES */
// Add Crew Card (Certifications)
function addCrewCards() {
    global $connection;

    $crew_id = $_POST['crew_id'];
    $launch_master = isset($_POST['launch_master']) ? $_POST['launch_master'] : null;
    $launch_master_card = $_POST['launch_master_card'];
    $lines_boat_master_inner = isset($_POST['lines_boat_master_inner']) ? $_POST['lines_boat_master_inner'] : null;
    $lines_boat_master_inner_card = $_POST['lines_boat_master_inner_card'];
    $lines_boat_master_outer = isset($_POST['lines_boat_master_outer']) ? $_POST['lines_boat_master_outer'] : null;
    $lines_boat_master_outer_card = $_POST['lines_boat_master_outer_card'];
    $deck_hand_launch = isset($_POST['deck_hand_launch']) ? $_POST['deck_hand_launch'] : null;
    $deck_hand_launch_card = $_POST['deck_hand_launch_card'];
    $deck_hand_lines_boat = isset($_POST['deck_hand_lines_boat']) ? $_POST['deck_hand_lines_boat'] : null;
    $deck_hand_lines_boat_card = $_POST['deck_hand_lines_boat_card'];
    $msic = isset($_POST['msic']) ? $_POST['msic'] : null;
    $msic_card = $_POST['msic_card'];
    $basic_rigger = isset($_POST['basic_rigger']) ? $_POST['basic_rigger'] : null;
    $basic_rigger_card = $_POST['basic_rigger_card'];
    $dogman = isset($_POST['dogman']) ? $_POST['dogman'] : null;
    $dogman_card = $_POST['dogman_card'];
    $cv_or_cv_crane = isset($_POST['cv_or_cv_crane']) ? $_POST['cv_or_cv_crane'] : null;
    $cv_or_cv_crane_card = $_POST['cv_or_cv_crane_card'];

    $query = "INSERT INTO `crew_cert` (`id`, `launch_master`, `launch_master_card`, `lines_boats_master_inner`, `lines_boats_master_inner_card`, `lines_boats_master_outer`, `lines_boats_master_outer_card`, `deck_hand_launch`, `deck_hand_launch_card`, `deck_hand_lines_boat`, `deck_hand_lines_boat_card`, `msic`, `msic_card`, `basic_rigger`, `basic_rigger_card`, `dogman`, `dogman_card`, `cv_or_cv_crane`, `cv_or_cv_crane_card`, `crew_id`) VALUES (NULL, '$launch_master', '$launch_master_card', '$lines_boat_master_inner', '$lines_boat_master_inner_card', '$lines_boat_master_outer', '$lines_boat_master_outer_card', '$deck_hand_launch', '$deck_hand_launch_card', '$deck_hand_lines_boat', '$deck_hand_lines_boat_card', '$msic', '$msic_card', '$basic_rigger', '$basic_rigger_card', '$dogman', '$dogman_card', '$cv_or_cv_crane', '$cv_or_cv_crane_card', '$crew_id');";


    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    if($result) {
        header("Location:../../../../index.php");
        exit();
    }

}

// View Crew Card (Certifications)
function displaySingleCrewCerts() {
    echo "<h3>Crew Certifications</h3>";
    global $connection;

    $id = $_GET['id'];

    $sql  = "SELECT * FROM `crew_cert` WHERE `crew_cert`.`crew_id` = $id";
//    $query = "SELECT * FROM `crew_cert` WHERE `crew_cert`.`crew_id` = '$id';";

    $result = mysqli_query($connection, $sql);
    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    while($cert = mysqli_fetch_assoc($result)) {
        if($cert['launch_master'] == 'on') {
            echo "<label><i class=\"fas fa-check\"></i> Launch Master</label>";
        } else {
            echo "<label><i class=\"fas fa-times\"></i> Launch Master</label>";
        };
        if($cert['lines_boats_master_inner'] == 'on') {
            echo "<label><i class=\"fas fa-check\"></i> Lines Boat Master - Inner Habour</label>";
        } else {
            echo "<label><i class=\"fas fa-times\"></i> Lines Boat Master - Inner Habour</label>";
        };
        if($cert['lines_boats_master_outer'] == 'on') {
            echo "<label><i class=\"fas fa-check\"></i> Lines Boat Master - Outer Habour</label>";
        } else {
            echo "<label><i class=\"fas fa-times\"></i> Lines Boat Master - Outer Habour</label>";
        };
        if($cert['deck_hand_launch'] == 'on') {
            echo "<label><i class=\"fas fa-check\"></i> Deck Hand - Launch</label>";
        } else {
            echo "<label><i class=\"fas fa-times\"></i> Deck Hand - Launch</label>";
        };
        if($cert['deck_hand_lines_boat'] == 'on') {
            echo "<label><i class=\"fas fa-check\"></i> Deck Hand - Lines Boat</label>";
        } else {
            echo "<label><i class=\"fas fa-times\"></i> Deck Hand - Lines Boat</label>";
        };
        if($cert['msic'] == 'on') {
            echo "<label><i class=\"fas fa-check\"></i> MSIC</label>";
        } else {
            echo "<label><i class=\"fas fa-times\"></i> MSIC</label>";
        };
        if($cert['basic_rigger'] == 'on') {
            echo "<label><i class=\"fas fa-check\"></i> Basic Rigger</label>";
        } else {
            echo "<label><i class=\"fas fa-times\"></i> Basic Rigger</label>";
        };
        if($cert['dogman'] == 'on') {
            echo "<label><i class=\"fas fa-check\"></i> Dogman</label>";
        } else {
            echo "<label><i class=\"fas fa-times\"></i> Dogman</label>";
        };
        if($cert['cv_or_cv_crane'] == 'on') {
            echo "<label><i class=\"fas fa-check\"></i> CV or CV Crane</label>";
        } else {
            echo "<label><i class=\"fas fa-times\"></i> CV or CV Crane</label>";
        };
    };

}

/** -- CREW SHIFTS QUERIES */

/** -- CREW TIME SHEETS QUERIES */

/** -- SHIP QUERIES */

// Create a new SHIP and inputs it into the database
// For Agent Queries, please see AGENT QUERIES section below

function createNewShip() {
    global $connection;

    $imo_number = $_POST['imo_number'];
    $ship_name = $_POST['ship_name'];
    $agency_id = $_POST['agency'];

    $crew_id = $_COOKIE['user'];

    $query = "INSERT INTO `ship` (`imo_number`, `ship_name`, `agency_id`, `archive`) VALUES ('$imo_number', '$ship_name', '$agency_id', NULL);";


    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    if($result) {
        header("Location:../../portals/crew/profile/crew-view.php?id=$crew_id");
        exit();
    }
}

// Get All Ship profiles for table list view
function displayAllShips() {
    global $connection;
    $query = "SELECT * FROM ship WHERE 1";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Query failed:');
    };

//    echo "<form action='crew-profiles.php?id=" . $row['id'] . "' method='post'>";
    echo "<table class=\"table table-hover\">";
    echo "<thead>";
    echo "<tr>";
    echo "<th scope=\"col\">IMO Number#</th>";
    echo "<th scope=\"col\">Ship Name</th>";
//    echo "<th scope=\"col\">Agency Name</th>";
    echo "<th scope=\"col\">Actions</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['imo_number'] . "</td>";
        echo "<td>" . $row['ship_name'] . "</td>";
//        echo "<td>" . $row['agency_name'] . "</td>";
        echo "<td>";
        echo "<a type='button' class='btn btn-primary mr-2' href=\"ship-view.php?imo_number=" . $row['imo_number'] . ".\">View</a>";
        echo "<a type='button' class='btn btn-primary mr-2' href=\"ship-update.php?imo_number=" . $row['imo_number'] . ".\">Edit</a>";
        echo "<a type='button' class='btn btn-danger' href=\"ship-archive.php?imo_number=" . $row['imo_number'] . ".\">Delete</a>";
        echo "</td>";
        echo "</tr>";
    };
    echo "</tbody>";
    echo "</table>";
//    echo "</form>";

    $crew_id = $_COOKIE['user'];

    echo "<div class='col-6'>";
    echo "<a class='btn btn-primary' href='../../portals/crew/profile/crew-view.php?id=".$crew_id."'>Go Back</a>";
    echo "</div>";


}

// Get and display all Ship data for complete list display
function displaySingleShipData() {
    global $connection;

    if (isset($_GET['imo_number'])) {
        $imo_number = $_GET['imo_number'];

        $query = "SELECT * FROM `ship` WHERE `ship`.`imo_number` = '$imo_number'";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Query failed:' . mysqli_error($connection));
        };

        $ship = mysqli_fetch_assoc($result);

        echo "<div class='card-header blue-bkgrd'>";
        echo "<h2>Ship View</h2>";
        echo "</div>";

        echo "<div class='card-body'>";
        echo "<div class='row'>";
        echo "<div class='col-6'>";
        echo "<p class='card-text' style='font-size: 1.5rem;'>Ship IMO Number: " . $ship['imo_number']."</p>";
        echo "</div>";
        echo "<div class='col-6'>";
        echo "<p class='card-text' style='font-size: 1.5rem;'>Ship Name: " . $ship['ship_name']."</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

    }
}

// Get and display all Ship data for editing
function getSingleShip() {
    global $connection;

    if (isset($_GET['imo_number'])) {

        $imo_number = $_GET['imo_number'];

        $query = "SELECT * FROM `ship` WHERE `ship`.`imo_number` = '$imo_number'";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Query failed:' . mysqli_error($connection));
        };

        $ship = mysqli_fetch_assoc($result);

        echo "<form class=\"col-12\" action=\"ship-update.php\" method=\"post\">";
        echo "<div class=\"row\">";
        echo "<div class=\"col-6 form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"imo_number\" value=\"" . $ship['imo_number'] . "\">";
        echo "</div>";
        echo "<div class=\"col-6 form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"ship_name\" value=\"" . $ship['ship_name'] . "\">";
        echo "</div>";
        echo "</div>";
        echo "<div class=\"row\">";
        echo "<div class=\"col-6\">";
        echo "<button class=\"btn btn-primary btn-lg pl-5 pr-5\" type=\"submit\" name=\"update_ship\">Save Changes</button>";
        echo "</div>";
        echo "</div>";
        echo "</form>";
    }
}

// Edit the specific Ship details
function editSingleShipData() {
    global $connection;

    $id = $_COOKIE['user'];
    $imo_number = $_POST['imo_number'];
    $ship_name = $_POST['ship_name'];


    $query = "UPDATE `ship` SET `imo_number` = '$imo_number', `ship_name` = '$ship_name' WHERE `ship`.`imo_number` = '$imo_number';";

    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    if($result) {
        header("Location:../../portals/crew/profile/crew-view.php?id=$id");
        exit();
    }
}

// Get a Ship from the database ready to Delete
function getSingleShipForDelete() {
    global $connection;

    if (isset($_GET['imo_number'])) {

        $imo_number = $_GET['imo_number'];

        $query = "SELECT * FROM `ship` WHERE `ship`.`imo_number` = '$imo_number'";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Query failed:' . mysqli_error($connection));
        };

        $ship = mysqli_fetch_assoc($result);

        echo "<form class=\"col-12\" action=\"ship-archive.php\" method=\"post\">";
        echo "<div class=\"row\">";
        echo "<div class=\"col-6 form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"imo_number\" value=\"" . $ship['imo_number'] . "\">";
        echo "</div>";
        echo "<div class=\"col-6 form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"ship_name\" value=\"" . $ship['ship_name'] . "\">";
        echo "</div>";
        echo "</div>";
        echo "<div class=\"row\">";
        echo "<div class=\"col-6\">";
        echo "<button class=\"btn btn-primary btn-lg pl-5 pr-5\" type=\"submit\" name=\"archive_ship\">Confirm</button>";
        echo "</div>";
        echo "</div>";
        echo "</form>";
    }
}

// Delete a Ship from the database
function deleteShipData() {
    global $connection;

    $id = $_COOKIE['user'];
    $imo_number = $_POST['imo_number'];


    $query = "DELETE FROM `ship` WHERE `ship`.`imo_number` = '$imo_number';";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    if($result) {
        header("Location:../crew/profile/crew-view.php?id=$id");
        exit();
    }

}

/** -- AGENT QUERIES */

// Create a new AGENT and inputs it into the database
// For SHIP Queries, please see SHIP QUERIES section Above

function createNewAgent() {
    global $connection;

    $agency_name = $_POST['agency_name'];
    $agency_code = $_POST['agency_code'];
    $contact_name = $_POST['contact_name'];
    $contact_email = $_POST['contact_email'];
    $contact_phone = $_POST['contact_phone'];



    $query = "INSERT INTO `agency` (`id`, `agency_name`, `agency_code`, `contact_name`, `contact_email`, `contact_phone`) VALUES (NULL, '$agency_name', '$agency_code', '$contact_name', '$contact_email', '$contact_phone');";


    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    $crew_id = $_COOKIE['user'];

    if($result) {
        header("Location:../../portals/crew/profile/crew-view.php?id=$crew_id");
        exit();
    }
}

// Get All Agent profiles for table list view
function displayAllAgents() {
    global $connection;
    $query = "SELECT * FROM agency WHERE 1";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Query failed:');
    };

//    echo "<form action='crew-profiles.php?id=" . $row['id'] . "' method='post'>";
    echo "<table class=\"table table-hover\">";
    echo "<thead>";
    echo "<tr>";
    echo "<th class='d-none' scope=\"col\">#</th>";
    echo "<th scope=\"col\">Agency Name</th>";
    echo "<th class='d-none' scope=\"col\">Agency Code</th>";
    echo "<th scope=\"col\">Best Contact</th>";
    echo "<th class='d-none' scope=\"col\">Contact Email</th>";
    echo "<th class='d-none' scope=\"col\">Contact Phone</th>";
    echo "<th scope=\"col\">Actions</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td class='d-none'>" . $row['id'] . "</td>";
        echo "<td>" . $row['agency_name'] . "</td>";
        echo "<td class='d-none'>" . $row['agency_code'] . "</td>";
        echo "<td>" . $row['contact_name'] . "</td>";
        echo "<td class='d-none'>" . $row['contact_email'] . "</td>";
        echo "<td class='d-none'>" . $row['contact_phone'] . "</td>";
        echo "<td>";
        echo "<a type='button' class='btn btn-primary mr-2' href=\"agent-view.php?id=" . $row['id'] . ".\">View</a>";
        echo "<a type='button' class='btn btn-primary mr-2' href=\"agent-update.php?id=" . $row['id'] . ".\">Edit</a>";
        echo "<a type='button' class='btn btn-danger' href=\"agent-archive.php?id=" . $row['id'] . ".\">Delete</a>";
//        echo "</td>";
        echo "</tr>";
    };
    echo "</tbody>";
    echo "</table>";
//    echo "</form>";

    $crew_id = $_COOKIE['user'];

    echo "<div class='col-6'>";
    echo "<a class='btn btn-primary' href='../../portals/crew/profile/crew-view.php?id=".$crew_id."'>Go Back</a>";
    echo "</div>";


}

// Get and display all Agent data for display
function displaySingleAgentData() {
    global $connection;

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM `agency` WHERE `agency`.`id` = '$id'";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Query failed:' . mysqli_error($connection));
        };

        $agent = mysqli_fetch_assoc($result);

        echo "<div class='card-header blue-bkgrd'>";
        echo "<h2>Agent Code: " . $agent['agency_code'] . ", Agent Name: " . $agent['agency_name'] . "</h2>";
        echo "</div>";

        echo "<div class='card-body'>";
        echo "<div class='row'>";
        echo "<div class='col-4'>";
        echo "<p class='card-text' style='font-size: 1.5rem;'>Best Contact: " . $agent['contact_name'] ."</p>";
        echo "</div>";
        echo "<div class='col-4'>";
        echo "<p class='card-text' style='font-size: 1.5rem;'>Contact's Email: " . $agent['contact_email'] ."</p>";
        echo "</div>";
        echo "<div class='col-4'>";
        echo "<p class='card-text' style='font-size: 1.5rem;'>Contact's Phone: " . $agent['contact_phone'] ."</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

    }
}

// Get and display all Agent data for editing
function getSingleAgent() {
    global $connection;

    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $query = "SELECT * FROM `agency` WHERE `agency`.`id` = '$id'";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Query failed:' . mysqli_error($connection));
        };

        $agent = mysqli_fetch_assoc($result);

        echo "<form class=\"col-12\" action=\"agent-update.php\" method=\"post\">";
        echo "<div class='row'>";
        echo "<input class=\"form-control d-none\" type=\"text\" name=\"id\" value=\"" . $agent['id'] . "\">";
        echo "</div>";
        echo "<div class=\"row\">";
        echo "<div class=\"col-4 form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"agency_name\" value=\"" . $agent['agency_name'] . "\">";
        echo "</div>";
        echo "<div class=\"col-4 form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"agency_code\" value=\"" . $agent['agency_code'] . "\">";
        echo "</div>";
        echo "<div class=\"col-4 form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"contact_name\" value=\"" . $agent['contact_name'] . "\">";
        echo "</div>";
        echo "</div>";
        echo "<div class=\"row\">";
        echo "<div class=\"col-8 form-group\">";
        echo "<input class=\"form-control\" type=\"email\" name=\"contact_email\" value=\"" . $agent['contact_email'] . "\" value=\"" . $agent['contact_email'] . "\">";
        echo "</div>";
        echo "<div class=\"col-4 form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"contact_phone\" value=\"" . $agent['contact_phone'] . "\">";
        echo "</div>";
        echo "</div>";
        echo "<div class=\"row\">";
        echo "<div class=\"col-6\">";
        echo "<button class=\"btn btn-primary btn-lg pl-5 pr-5\" type=\"submit\" name=\"update_agent\">Save Changes</button>";
        echo "</div>";
        echo "</div>";
        echo "</form>";
    }
}

// Edit the specific Agency details
function editSingleAgentData() {
    global $connection;

    $crew_id = $_COOKIE['user'];

    $id = $_POST['id'];
    $agency_name = $_POST['agency_name'];
    $agency_code = $_POST['agency_code'];
    $contact_name = $_POST['contact_name'];
    $contact_email = $_POST['contact_email'];
    $contact_phone = $_POST['contact_phone'];


    $query = "UPDATE `agency` SET `agency_name` = '$agency_name', `agency_code` = '$agency_code', `contact_name` = '$contact_name', `contact_email` = '$contact_email', `contact_phone` = '$contact_phone' WHERE `agency`.`id` = '$id';";

    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    if($result) {
        header("Location:../../portals/crew/profile/crew-view.php?id=$crew_id");
        exit();
    }
}

// Get an Agent from the database ready to Delete
function getSingleAgentForDelete() {
    global $connection;

    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $query = "SELECT * FROM `agency` WHERE `agency`.`id` = '$id'";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Query failed:' . mysqli_error($connection));
        };

        $agent = mysqli_fetch_assoc($result);

        echo "<form class=\"col-12\" action=\"agent-archive.php\" method=\"post\">";
        echo "<div class='row'>";
        echo "<input class=\"form-control d-none\" type=\"text\" name=\"id\" value=\"" . $agent['id'] . "\">";
        echo "</div>";
        echo "<div class=\"row\">";
        echo "<div class=\"col-4 form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"agency_name\" value=\"" . $agent['agency_name'] . "\">";
        echo "</div>";
        echo "<div class=\"col-4 form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"agency_code\" value=\"" . $agent['agency_code'] . "\">";
        echo "</div>";
        echo "<div class=\"col-4 form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"contact_name\" value=\"" . $agent['contact_name'] . "\">";
        echo "</div>";
        echo "</div>";
        echo "<div class=\"row\">";
        echo "<div class=\"col-8 form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"contact_email\" value=\"" . $agent['contact_email'] . "\">";
        echo "</div>";
        echo "<div class=\"col-4 form-group\">";
        echo "<input class=\"form-control\" type=\"text\" name=\"contact_phone\" value=\"" . $agent['contact_phone'] . "\">";
        echo "</div>";
        echo "</div>";
        echo "<div class=\"row\">";
        echo "<div class=\"col-6\">";
        echo "<button class=\"btn btn-primary btn-lg pl-5 pr-5\" type=\"submit\" name=\"archive_agent\">Confirm</button>";
        echo "</div>";
        echo "</div>";
        echo "</form>";
    }
}

// Delete an Agent from the database
function deleteAgentData() {
    global $connection;

    $id = $_POST['id'];

    $crew_id = $_COOKIE['user'];


    $query = "DELETE FROM `agency` WHERE `agency`.`id` = '$id';";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    if($result) {
        header("Location:../../portals/crew/profile/crew-view.php?id=$crew_id");
        exit();
    }

}

// Make a <select> tag with all Agents in database
function selectAgency() {
    global $connection;
    $query = "SELECT * FROM agency WHERE 1";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    echo "<label for='agency' class=\"h5\">AGENCY</label>";
    echo "<select id='agency' class='form-control form-control-sm' name='agency'>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<option value='".$row['id']."'>".$row['agency_code'].": ".$row['agency_name']."</option>";
    }
    echo "</select>";
}

/** -- JOB SHEET QUERIES */

// Create a new JOB SHEET and inputs it into the database
// For ADDITIONAL JOB SHEET RELATED Queries, please see corresponding QUERIES section Below
function createNewJobSheet() {
    global $connection;

    $job_id = isset($_POST['job_id']) ? $_POST['job_id'] : null;
    $date =  isset($_POST['date']) ? $_POST['date'] : null;
    $start_time =  isset($_POST['start_time']) ? $_POST['start_time'] : null;
    $end_time =  isset($_POST['end_time']) ? $_POST['end_time'] : null;
    $port_of_origin = isset($_POST['port_of_origin']) ? $_POST['port_of_origin'] : null;
    $vessel = isset($_POST['vessel']) ? $_POST['vessel'] : null;
    $master = isset($_POST['master']) ? $_POST['master'] : 0;
    $crew1 = isset($_POST['crew1']) ? $_POST['crew1'] : 0;
    $crew2 = isset($_POST['crew2']) ? $_POST['crew2'] : 0;
    $agency_id = isset($_POST['agency']) ? $_POST['agency'] : null;
    $authorised_by = isset($_POST['authorised_by']) ? $_POST['authorised_by'] : null;
    $purchase_order = isset($_POST['purchase_order']) ? $_POST['purchase_order'] : null;
    $attending = isset($_POST['attending']) ? $_POST['attending'] : null;
    $attending_ship = isset($_POST['attending_ship']) ? $_POST['attending_ship'] : null;
    $outside_limit = isset($_POST['outside_limit']) ? $_POST['outside_limit'] : null;
    $inner_habour = isset($_POST['inner_habour']) ? $_POST['inner_habour'] : null;
    $outer_habour = isset($_POST['outer_habour']) ? $_POST['outer_habour'] : null;
    $anchorage = isset($_POST['anchorage']) ? $_POST['anchorage'] : null;
    $berth_anchorage = isset($_POST['berth_anchorage']) ? $_POST['berth_anchorage'] : null;
    $transfer_personnel = isset($_POST['transfer_personnel']) ? $_POST['transfer_personnel'] : null;
    $transfer_pilot = isset($_POST['transfer_pilot']) ? $_POST['transfer_pilot'] : null;
    $lines_boat = isset($_POST['lines_boat']) ? $_POST['lines_boat'] : null;
    $drill_frc = isset($_POST['drill_frc']) ? $_POST['drill_frc'] : null;
    $drill_lifeboat = isset($_POST['drill_lifeboat']) ? $_POST['drill_lifeboat'] : null;
    $drill_other = isset($_POST['drill_other']) ? $_POST['drill_other'] : null;
    $drill_other_type = isset($_POST['drill_other_type']) ? $_POST['drill_other_type'] : null;
    $comments = isset($_POST['comments']) ? $_POST['comments'] : null;

    $query = "INSERT INTO `jobsheet` (`id`, `job_id`, `date`, `start_time`, `end_time`, `port_of_origin`, `vessel`, `master`, `crew1`, `crew2`, `agency_id`, `authorised_by`, `purchase_order`, `attending`, `attending_ship`, `outside_limit`, `inner_habour`, `outer_habour`, `anchorage`, `berth_anchorage`, `transfer_personnel`, `transfer_pilot`, `lines_boat`, `drill_frc`, `drill_lifeboat`, `drill_other`, `drill_other_type`, `comments`, `total_hours`) VALUES (NULL, '$job_id', '$date', '$start_time', '$end_time', '$port_of_origin', '$vessel', '$master', '$crew1', '$crew2', '$agency_id', '$authorised_by', '$purchase_order', '$attending', '$attending_ship', '$outside_limit', '$inner_habour', '$outer_habour', '$anchorage', '$berth_anchorage', '$transfer_personnel', '$transfer_pilot', '$lines_boat', '$drill_frc', '$drill_lifeboat', '$drill_other', '$drill_other_type', '$comments', NULL);";

//    $query = "INSERT INTO `jobsheet` (`id`, `job_id`, `date`, `start_time`, `end_time`, `port_of_origin`, `vessel`, `master`, `crew1`, `crew2`, `agency_id`, `authorised_by`, `purchase_order`, `attending`, `attending_ship`, `outside_limit`, `inner_habour`, `outer_habour`, `anchorage`, `berth_anchorage`, `transfer_personnel`, `transfer_pilot`, `lines_boat`, `drill_frc`, `drill_lifeboat`, `drill_other`, `drill_other_type` `comments`, `total_hours`) VALUES (NULL, '$job_id', '$date', '$start_time', '$end_time', '$port_of_origin', '$vessel', '$master', '$crew1', '$crew2', '$agency_id', '$authorised_by', '$purchase_order', '$attending', '$attending_ship', '$outside_limit', '$inner_habour', '$outer_habour', '$anchorage', '$berth_anchorage', '$transfer_personnel', '$transfer_pilot' '$lines_boat', '$drill_frc', '$drill_lifeboat', '$drill_other', '$drill_other_type', '$comments', null);";


    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    $id = $_COOKIE['user'];

    if($result) {
        header("Location:../../crew/profile/crew-view.php?id=$id");
        exit();
    }
}

// For ADDITIONAL JOB SHEET RELATED Queries, please see corresponding QUERIES section Below
function editJobSheetView() {

    global $connection;

    $id = $_GET['id'];

    $query = "SELECT * FROM `jobsheet` WHERE `jobsheet`.`id` = '$id'";


    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    $jobsheet = mysqli_fetch_assoc($result);



echo "<form class=\"col-12\" action=\"job-sheet-edit.php\" method=\"post\">";
echo "<div class=\"row\">";
echo "<div class=\"col-12 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"id\" value='".$jobsheet['id']."'>";
echo "</div>";
echo "</div>";
echo "<div class=\"row\">";
echo "<div class=\"col-12 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"job_id\" value='".$jobsheet['job_id']."'>";
echo "</div>";
echo "</div>";
echo "<div class=\"row\">";
echo "<div class=\"col-4 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"date\"value='".$jobsheet['date']."'>";
echo "</div>";
echo "<div class=\"col-4 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"start_time\" value='".$jobsheet['start_time']."'>";
echo "</div>";
echo "<div class=\"col-4 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"end_time\" value='".$jobsheet['end_time']."'>";
echo "</div>";
echo "</div>";
echo "<div class=\"row\">";
echo "<div class=\"col-12 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"port_of_origin\" value='".$jobsheet['port_of_origin']."'>";
echo "</div>";
echo "</div>";
echo "<div class=\"row\">";
echo "<div class=\"col-12 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"vessel\" value='".$jobsheet['vessel']."'>";
echo "</div>";
echo "</div>";

echo "<div class=\"row\">";
echo "<div class=\"col-4 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"agency_id\" value='".$jobsheet['agency_id']."'>";
echo "</div>";
echo "<div class=\"col-4 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"authorised_by\" value='".$jobsheet['authorised_by']."'>";
echo "</div>";
echo "<div class=\"col-4 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"purchase_order\" value='".$jobsheet['purchase_order']."'>";
echo "</div>";
echo "</div>";
echo "<div class=\"row\">";
echo "<div class=\"col-12 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"attending\" value='".$jobsheet['attending']."'>";
echo "</div>";
echo "</div>";
echo "<div class=\"row\">";
echo "<div class=\"col-2 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"outside_limit\" value='".$jobsheet['outside_limit']."'>";
echo "</div>";
echo "<div class=\"col-2 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"inner_habour\" value='".$jobsheet['inner_habour']."'>";
echo "</div>";
echo "<div class=\"col-3 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"outer_habour\" value='".$jobsheet['outer_habour']."'>";
echo "</div>";
echo "<div class=\"col-3 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"anchorage\" value='".$jobsheet['anchorage']."'>";
echo "</div>";
echo "<div class=\"col-2 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"berth_anchorage\" value='".$jobsheet['berth_anchorage']."'>";
echo "</div>";
echo "</div>";
echo "<div class=\"row\">";
echo "<div class=\"col-4 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"transfer_personnel\" value='".$jobsheet['transfer_personnel']."'>";
echo "<input class=\"form-control\" type=\"text\" name=\"transfer_pilot\" value='".$jobsheet['transfer_pilot']."'>";
echo "</div>";
echo "<div class=\"col-4 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"lines_boat\" value='".$jobsheet['lines_boat']."'>";
echo "</div>";
echo "<div class=\"col-4 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"drill_frc\" value='".$jobsheet['drill_frc']."'>";
echo "<input class=\"form-control\" type=\"text\" name=\"drill_lifeboat\" value='".$jobsheet['drill_lifeboat']."'>";
echo "<input class=\"form-control\" type=\"text\" name=\"drill_other\" value='".$jobsheet['drill_other']."'>";
echo "<input class=\"form-control\" type=\"text\" name=\"drill_other_type\" value='".$jobsheet['drill_other_type']."'>";
echo "</div>";
echo "</div>";
echo "<div class=\"row\">";
echo "<div class=\"col-12 form-group\">";
echo "<input class=\"form-control\" type=\"text\" name=\"comments\" value='".$jobsheet['comments']."'>";
echo "</div>";
echo "</div>";
echo "<div class=\"row\">";
echo "<div class=\"col-6\">";
echo "<button class=\"btn btn-primary btn-lg pl-5 pr-5\" type=\"submit\" name=\"edit-jobsheet\">Save</button>";
echo "</div>";
echo "</div>";
echo "</form>";

}

function saveEditJobSheet() {

    global $connection;

    $id = $_POST['id'];
    $job_id = $_POST['job_id'];
    $date =  $_POST['date'];
    $start_time =  $_POST['start_time'];
    $end_time =  $_POST['end_time'];
    $port_of_origin = $_POST['port_of_origin'];
    $vessel = $_POST['vessel'];
    $master = $_POST['master'];
    $crew1 = $_POST['crew1'];
    $crew2 = $_POST['crew2'];
    $agency_id = $_POST['agency'];
    $authorised_by = $_POST['authorised_by'];
    $purchase_order = $_POST['purchase_order'];
    $attending = $_POST['attending'];
    $attending_ship = $_POST['attending_ship'];
    $outside_limit = $_POST['outside_limit'];
    $inner_habour = $_POST['inner_habour'];
    $outer_habour = $_POST['outer_habour'];
    $anchorage = $_POST['anchorage'];
    $berth_anchorage = $_POST['berth_anchorage'];
    $transfer_personnel = $_POST['transfer_personnel'];
    $transfer_pilot = $_POST['transfer_pilot'];
    $lines_boat = $_POST['lines_boat'];
    $drill_frc = $_POST['drill_frc'];
    $drill_lifeboat = $_POST['drill_lifeboat'];
    $drill_other = $_POST['drill_other'];
    $drill_other_type = $_POST['drill_other_type'];
    $comments = $_POST['comments'];


    $query = "UPDATE `jobsheet` SET `job_id` = '$job_id', `date` = '$date', `start_time` = '$start_time', `end_time` = '$end_time', `port_of_origin` = '$port_of_origin', `vessel` = '$vessel', `master` = '$master', `crew1` = '$crew1', `crew2` = '$crew2', `agency_id` = '$agency_id', `authorised_by` = '$authorised_by', `purchase_order` = '$purchase_order', `attending` = '$attending', `attending_ship` = '$attending_ship', `outside_limit` = '$outside_limit', `inner_habour` = '$inner_habour', `outer_habour` = '$outer_habour', `anchorage` = '$anchorage', `berth_anchorage` = '$berth_anchorage', `transfer_personnel` = '$transfer_personnel', `transfer_pilot` = '$transfer_pilot', `lines_boat` = '$lines_boat', `drill_frc` = '$drill_frc', `drill_lifeboat` = '$drill_lifeboat', `drill_other` = '$drill_other', `drill_other_type` = '$drill_other_type', `comments` = '$comments', `total_hours` = NULL WHERE `jobsheet`.`id` = '$id'";


    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    $id = $_COOKIE['user'];

    if($result) {
        header("Location:../../crew/profile/crew-view.php?id=$id");
        exit();
    }
}

// Get All Job Sheets for table list view
function displayAllJobSheets() {
    global $connection;


    $query = "SELECT * FROM jobsheet WHERE 1";
    $result = mysqli_query($connection, $query);


    if (!$result) {
        die('Query failed:');
    };

//    echo "<form action='crew-profiles.php?id=" . $row['id'] . "' method='post'>";
    echo "<table class=\"table table-hover\">";
    echo "<thead>";
    echo "<tr>";
    echo "<th scope=\"col\">ABWA Job No#</th>";
    echo "<th scope=\"col\">Date</th>";
    echo "<th scope=\"col\">Start</th>";
    echo "<th scope=\"col\">Port of Origin</th>";
    echo "<th scope=\"col\">Actions</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>". $row['job_id']."</td>";
        echo "<td>". $row['date']."</td>";
        echo "<td>". $row['start_time']."</td>";
        echo "<td>". $row['end_time']."</td>";
        echo "<td>". $row['port_of_origin']."</td>";
        echo "<td>";
        echo "<a type='button' class='btn btn-primary mr-2' href=\"job-sheet-view.php?id=" . $row['id'] . ".\">View</a>";
        echo "<a type='button' class='btn btn-primary mr-2' href=\"job-sheet-edit.php?id=" . $row['id'] . ".\">Edit</a>";
//        echo "<a type='button' class='btn btn-danger' href=\"agent-archive.php?id=" . $row['id'] . ".\">Delete</a>";
        echo "</td>";
        echo "</tr>";
    };
    echo "</tbody>";
    echo "</table>";
//    echo "</form>";




}

// Get and display all Agent data for display
function displaySingleJobSheet() {
    global $connection;

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM `jobsheet` WHERE `jobsheet`.`id` = '$id'";


        $result = mysqli_query($connection, $query);

        if (!$result) {
            die('Query failed:' . mysqli_error($connection));
        };

        $jobsheet = mysqli_fetch_assoc($result);
        $agencyID = $jobsheet['agency_id'];
        $crew1ID = $jobsheet['crew1'];
        $crew2ID = $jobsheet['crew2'];

        $queryAgency = "SELECT * FROM `agency` WHERE `agency`.`id` = '$agencyID'";
        $queryCrew1 = "SELECT * FROM `crew` WHERE `crew`.`id` = '$crew1ID'";
        $queryCrew2 = "SELECT * FROM `crew` WHERE `crew`.`id` = '$crew2ID'";
        $agencyResult = mysqli_query($connection, $queryAgency);
        $crew1Result = mysqli_query($connection, $queryCrew1);
        $crew2Result = mysqli_query($connection, $queryCrew2);

        $agency = mysqli_fetch_assoc($agencyResult);
        $crew1 = mysqli_fetch_assoc($crew1Result);
        $crew2 = mysqli_fetch_assoc($crew2Result);

        echo "<div class='row'>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>ABWA Job No#</label>";
            echo "</div>";
            echo "<div class='col-10 border border-dark'>";
                echo "<label>".$jobsheet['job_id']."</label>";
            echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>Date: </label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>".$jobsheet['date']."</label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>Start: </label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>".$jobsheet['start_time']." HOURS</label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>End: </label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>".$jobsheet['end_time']." HOURS</label>";
            echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>Port of Origin: </label>";
            echo "</div>";
            echo "<div class='col-10 border border-dark'>";
                echo "<label>".$jobsheet['port_of_origin']."</label>";
            echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>ABWA Vessel: </label>";
            echo "</div>";
            echo "<div class='col-10 border border-dark'>";
                echo "<label>".$jobsheet['vessel']."</label>";
            echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>Master: </label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>".$jobsheet['master']."</label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>Crew 1: </label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>".$crew1['first_name_crew']." ". $crew1['last_name_crew'] ."</label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>Crew 2: </label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>".$crew2['first_name_crew']." ". $crew2['last_name_crew'] ."</label>";
            echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>Agency: </label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>".$agency['agency_code'].": "."</label><br>";
                echo "<label>".$agency['agency_name']."</label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>Authorised By: </label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>".$jobsheet['authorised_by']."</label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>Purchase Order# </label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>".$jobsheet['purchase_order']."</label>";
            echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>Attending: </label>";
            echo "</div>";
            echo "<div class='col-10 border border-dark'>";
                echo "<label>".$jobsheet['attending']."</label>";
            echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
            echo "<div class='col-3 border border-dark'>";
                echo "<label>Outside Port Limits:<br>".$jobsheet['outside_limit']."</label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>Inner Habour:<br>".$jobsheet['inner_habour']."</label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>Outer Habour:<br>".$jobsheet['outer_habour']."</label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>Anchorage:<br>".$jobsheet['anchorage']."</label>";
            echo "</div>";
            echo "<div class='col-3 border border-dark'>";
                echo "<label>Berth or Archorage:<br>Letter or Number<br>#".$jobsheet['berth_anchorage']."</label>";
            echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>Transfer: </label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>".$jobsheet['transfer_personnel']."</label><br>";
                echo "<label>".$jobsheet['transfer_pilot']."</label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>Lines Boat: </label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>".$jobsheet['lines_boat']."</label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>Drill: </label>";
            echo "</div>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>".$jobsheet['drill_frc']."</label><br>";
                echo "<label>".$jobsheet['drill_lifeboat']."</label><br>";
                echo "<label>".$jobsheet['drill_other'].":<br>".$jobsheet['drill_other_type']."</label>";
            echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
            echo "<div class='col-2 border border-dark'>";
                echo "<label>Comments: </label>";
            echo "</div>";
            echo "<div class='col-10 border border-dark'>";
                echo "<label>".$jobsheet['comments']."</label>";
            echo "</div>";
        echo "</div>";
        echo "<div class=\"row\">";
        echo "<a href=\"../cargo/cargo-create.php?id=".$jobsheet['id']."\" class=\"btn btn-primary mt-5 mr-2\">Add Cargo Manifest</a>";
        echo "<a href=\"../equipment/equipment-hire-create.php?id=".$jobsheet['id']."\" class=\"btn btn-primary mt-5 mr-2\">Add Equipment Hire List</a>";
        echo "<a href=\"../personnel/personnel-hire-create.php?id=".$jobsheet['id']."\" class=\"btn btn-primary mt-5 mr-2\">Add Personnel Hire List</a>";
        echo "<a href=\"../passenger/passenger-manifest-create.php?=id".$jobsheet['id']."\" class=\"btn btn-primary mt-5 mr-2\">Add Passenger Manifest</a>";
        echo "</div>";
    }
}

// Retrieve Crew Id for future use
function retrieveJobId() {
    global $connection;

    $retrieve = "SELECT * FROM `jobsheet` ORDER by `id` DESC LIMIT 1;";

    $singleJob = mysqli_query($connection, $retrieve);

    if(!$singleJob) {
        die('Query failed:' . mysqli_error($connection));
    };

    $job = mysqli_fetch_assoc($singleJob);

    echo "<input type='text' class='form-control' name='job_id' value='".$job['id']."'>";
}


// Retrieve Active Job Sheet Master Shifts
function assignedMasterShifts() {

    global $connection;

    $id = $_COOKIE['user'];

    $masterQuery = "SELECT * FROM `jobsheet` WHERE `jobsheet`.`master` = $id;";

    $masterJob = mysqli_query($connection, $masterQuery);

    if(!$masterJob) {
        die('Query failed:' . mysqli_error($connection));
    };


    if (isset($_GET['id'])) {
        $crew_id = $_GET['id'];

        $query = "SELECT * FROM `crew` WHERE `crew`.`id` = '$crew_id'";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Query failed:' . mysqli_error($connection));
        };

        $crew = mysqli_fetch_assoc($result);


        if ($crew['normal'] == 'YES') {
            echo "<h3>Active Shifts for Master Position</h3>";
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Date</th>";
            echo "<th>Start</th>";
            echo "<th>End</th>";
            echo "<th>Location</th>";
            echo "</tr>";
            while ($master = mysqli_fetch_assoc($masterJob)) {
                echo "<tr>";
                echo "<td>" . $master['id'] . "</td>";
                echo "<td>" . $master['date'] . "</td>";
                echo "<td>" . $master['start_time'] . "</td>";
                echo "<td>" . $master['end_time'] . "</td>";
                echo "<td>" . $master['port_of_origin'] . "</td>";
                echo "</tr>";
            };
            echo "</table>";
        }
    }
}

// Retrieve Active Job Sheet Master Shifts
function acceptedCrew1Shifts() {

    global $connection;

    $id = $_COOKIE['user'];

    $masterQuery = "SELECT * FROM `jobsheet` WHERE `jobsheet`.`crew1` = $id;";

    $crew1Job = mysqli_query($connection, $masterQuery);

    if(!$crew1Job) {
        die('Query failed:' . mysqli_error($connection));
    };


    if (isset($_GET['id'])) {
        $crew_id = $_GET['id'];

        $query = "SELECT * FROM `crew` WHERE `crew`.`id` = '$crew_id'";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Query failed:' . mysqli_error($connection));
        };

        $crew = mysqli_fetch_assoc($result);


        if ($crew['normal'] == 'YES') {
            echo "<h3>Accepted Shifts for Crew 1 Position</h3>";
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Date</th>";
            echo "<th>Start</th>";
            echo "<th>End</th>";
            echo "<th>Location</th>";
            echo "</tr>";
            while ($crew1Shifts = mysqli_fetch_assoc($crew1Job)) {
                echo "<tr>";
                echo "<td>" . $crew1Shifts['id'] . "</td>";
                echo "<td>" . $crew1Shifts['date'] . "</td>";
                echo "<td>" . $crew1Shifts['start_time'] . "</td>";
                echo "<td>" . $crew1Shifts['end_time'] . "</td>";
                echo "<td>" . $crew1Shifts['port_of_origin'] . "</td>";
                echo "</tr>";
            };
            echo "</table>";
        }
    }
}

// Retrieve Active Job Sheet Master Shifts
function acceptedCrew2Shifts() {

    global $connection;

    $id = $_COOKIE['user'];

    $masterQuery = "SELECT * FROM `jobsheet` WHERE `jobsheet`.`crew2` = $id;";

    $crew2Job = mysqli_query($connection, $masterQuery);

    if(!$crew2Job) {
        die('Query failed:' . mysqli_error($connection));
    };


    if (isset($_GET['id'])) {
        $crew_id = $_GET['id'];

        $query = "SELECT * FROM `crew` WHERE `crew`.`id` = '$crew_id'";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Query failed:' . mysqli_error($connection));
        };

        $crew = mysqli_fetch_assoc($result);


        if ($crew['normal'] == 'YES') {
            echo "<h3>Accepted Shifts for Crew 2 Position</h3>";
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Date</th>";
            echo "<th>Start</th>";
            echo "<th>End</th>";
            echo "<th>Location</th>";
            echo "</tr>";
            while ($crew2Shifts = mysqli_fetch_assoc($crew2Job)) {
                echo "<tr>";
                echo "<td>" . $crew2Shifts['id'] . "</td>";
                echo "<td>" . $crew2Shifts['date'] . "</td>";
                echo "<td>" . $crew2Shifts['start_time'] . "</td>";
                echo "<td>" . $crew2Shifts['end_time'] . "</td>";
                echo "<td>" . $crew2Shifts['port_of_origin'] . "</td>";
                echo "</tr>";
            };
            echo "</table>";
        }
    }
}

// Retrieve Active Job Sheet Shifts
function getCurrentActiveCrew1Shifts() {

    global $connection;

//    $id = $_COOKIE['id'];

    $crew1 = "SELECT * FROM `jobsheet` WHERE `jobsheet`.`crew1` = 0;";

    $crew1Job = mysqli_query($connection, $crew1);

    if(!$crew1Job) {
        die('Query failed:' . mysqli_error($connection));
    };


    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM `crew` WHERE `crew`.`id` = '$id'";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Query failed:' . mysqli_error($connection));
        };

        $crew = mysqli_fetch_assoc($result);


        if ($crew['normal'] == 'YES') {
            echo "<h3>Active Shifts for First Crew Position</h3>";
            echo "<form action='crew-view.php' method='post'>";
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Date</th>";
            echo "<th>Start</th>";
            echo "<th>End</th>";
            echo "<th>Location</th>";
            echo "<th>Crew</th>";
            echo "<th>Accept</th>";
            echo "</tr>";
            while ($shift1 = mysqli_fetch_assoc($crew1Job)) {
                echo "<tr>";
                echo "<td><input type='text' name='id' value='" . $shift1['id'] . "'></td>";
                echo "<td>" . $shift1['date'] . "</td>";
                echo "<td>" . $shift1['start_time'] . "</td>";
                echo "<td>" . $shift1['end_time'] . "</td>";
                echo "<td>" . $shift1['port_of_origin'] . "</td>";
                echo "<td><input type='text' value='" . $shift1['crew1'] . "'></td>";
                echo "<td><button class='btn btn-primary' type='submit' name='acceptCrew1'><i class='fas fa-check'></i></button></td>";
                echo "</tr>";
            };
            echo "</table>";
            echo "</form>";
        }
    }
}

// Retrieve Active Job Sheet Shifts
function getCurrentActiveCrew2Shifts() {

    global $connection;

//    $id = $_COOKIE['id'];


    $crew2 = "SELECT * FROM `jobsheet` WHERE `jobsheet`.`crew2` = 0;";


    $crew2Job = mysqli_query($connection, $crew2);


    if(!$crew2Job) {
        die('Query failed:' . mysqli_error($connection));
    };

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM `crew` WHERE `crew`.`id` = '$id'";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Query failed:' . mysqli_error($connection));
        };

        $crew = mysqli_fetch_assoc($result);


        if ($crew['normal'] == 'YES') {

            echo "<h3>Active Shifts for Second Crew Position</h3>";
            echo "<form action='crew-view.php' method='post'>";
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Date</th>";
            echo "<th>Start</th>";
            echo "<th>End</th>";
            echo "<th>Location</th>";
            echo "<th>Crew</th>";
            echo "<th>Accept</th>";
            echo "</tr>";
            while ($shift2 = mysqli_fetch_assoc($crew2Job)) {
                echo "<tr>";
                echo "<td><input type='text' name='id' value='" . $shift2['id'] . "'></td>";
                echo "<td>" . $shift2['date'] . "</td>";
                echo "<td>" . $shift2['start_time'] . "</td>";
                echo "<td>" . $shift2['end_time'] . "</td>";
                echo "<td>" . $shift2['port_of_origin'] . "</td>";
                echo "<td><input type='text' value='" . $shift2['crew2'] . "'></td>";
                echo "<td><button class='btn btn-primary' type='submit' name='acceptCrew2'><i class='fas fa-check'></i></button></td>";
                echo "</tr>";
            };
            echo "</table>";
            echo "</form>";
        }
    }
}

// Adds Crew to a Jobsheet - CREW 1
function updateJobSheetWithAcceptCrew1() {
    global $connection;

    $id = $_COOKIE['user'];
    $job_id = $_POST['id'];

    $query = "UPDATE `jobsheet` SET `crew1` = '$id' WHERE `jobsheet`.`id` = $job_id;";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    if($result) {
        header("Location:crew-view.php?id=$id");
        exit();
    }
}

// Adds Crew to a Jobsheet - CREW 2
function updateJobSheetWithAcceptCrew2() {
    global $connection;

    $id = $_COOKIE['user'];
    $job_id = $_POST['id'];

    $query = "UPDATE `jobsheet` SET `crew2` = '$id' WHERE `jobsheet`.`id` = $job_id;";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    if($result) {
        header("Location:crew-view.php?id=$id");
        exit();
    }
}

/** -- CARGO QUERIES */
// Add Cargo to Job Sheet
function addCargo() {
    global $connection;

    $qty = $_POST['qty'];
    $item = $_POST['item'];
    $del_to = $_POST['del_to'];
    $voyage = $_POST['voyage'];
    $job_id = $_POST['job_id'];

    $query = "INSERT INTO `cargo` (`id`, `qty`, `item`, `del_to`, `voyage`, `job_id`) VALUES (NULL, '$qty', '$item', '$del_to', '$voyage', '$job_id');";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    if($result) {
        header("Location:cargo-create.php?id=$job_id");
        exit();
    }
//
}

// Display All Cargo associated with Job Sheet
function displayAllCargo() {
    echo "<h3>Display here all Cargo</h3>";
    global $connection;

        $id = $_GET['id'];

        $sql = "SELECT * FROM `cargo` WHERE `cargo`.`job_id` = $id";

        $result = mysqli_query($connection, $sql);
        if (!$result) {
            die('Query failed:' . mysqli_error($connection));
        };

    while($cargo = mysqli_fetch_assoc($result)) {
        echo "<form action='job-sheet-view.php' method='post'>";
//        echo "<div class='row'>";
//        echo "<div class='col-2 border border-dark'>";
//        echo "<label>ID: </label>";
//        echo "<input name='id' value='".$cargo['id']."'>";
//        echo "</div>";
//        echo "<div class='col-2 border border-dark'>";
//        echo "<label>JOB ID: </label>";
//        echo "<input name='job_id' value='".$cargo['job_id']."'>";
//        echo "</div>";
//        echo "</div>";
        echo "<div class='row'>";
        echo "<div class='col-2 border border-dark'>";
        echo "<label>QTY: </label>";
        echo "<label>" . $cargo['qty'] . "</label>";
        echo "</div>";
        echo "<div class='col-2 border border-dark'>";
        echo "<label>Item: </label>";
        echo "<label>" . $cargo['item'] . "</label>";
        echo "</div>";
        echo "<div class='col-2 border border-dark'>";
        echo "<label>Delivered to: </label>";
        echo "<label>" . $cargo['del_to'] . "</label>";
        echo "</div>";
        echo "<div class='col-2 border border-dark'>";
        echo "<label>Voyage: </label>";
        echo "<label>" . $cargo['voyage'] . "</label>";
        echo "</div>";
        echo "<div class='col-4 border border-dark'>";
//        echo "<a href='#' class='btn btn-primary' type='submit' name='cargo-edit'>Edit</a>";
//        echo "<button class='btn btn-danger' type='submit' name='cargo-delete'>Delete</button>";
        echo "</div>";
        echo "</div>";
        echo "</form>";
    };

}

// Delete an Cargo from the database
function deleteCargo() {
    global $connection;

    $cargo_id = $_POST['id'];
    $job_id = $_POST['job_id'];

//    echo "You clicked delete".$id;


    $query = "DELETE FROM `cargo` WHERE `cargo`.`id` = $cargo_id;";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    if($result) {
        header("Location:../jobsheet/job-sheet-view.php?id='$job_id'");
        exit();
    }

}


/** -- EQUIPMENT QUERIES */
// Add Equipment Hire to Job Sheet
function addEquipment() {
    global $connection;

    $equipment_type = $_POST['equipment_type'];
    $equipment_hrs = $_POST['equipment_hrs'];
    $equipment_days = $_POST['equipment_days'];
    $job_id = $_POST['job_id'];

    $query = "INSERT INTO `equipment` (`id`, `equipment_type`, `equipment_hrs`, `equipment_days`, `job_id`) VALUES (NULL, '$equipment_type', '$equipment_hrs', '$equipment_days', '$job_id');";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    if($result) {
        header("Location:equipment-hire-create.php?id=$job_id");
        exit();
    }
//
}

// Display All Equipment associated with Job Sheet
function displayAllEquipment() {
    echo "<h3>Display here all Equipment</h3>";

    global $connection;

    $id = $_GET['id'];

    $query = "SELECT * FROM `equipment` WHERE `equipment`.`job_id` = '$id'";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    while($equipment = mysqli_fetch_assoc($result)) {
        echo "<div class='row'>";
        echo "<div class='col-3 border border-dark'>";
        echo "<label>Type: </label>";
        echo "<label>" . $equipment['equipment_type'] . "</label>";
        echo "</div>";
        echo "<div class='col-3 border border-dark'>";
        echo "<label>Hours: </label>";
        echo "<label>" . $equipment['equipment_hrs'] . "</label>";
        echo "</div>";
        echo "<div class='col-3 border border-dark'>";
        echo "<label>Days: </label>";
        echo "<label>" . $equipment['equipment_days'] . "</label>";
        echo "</div>";
        echo "<div class='col-3 border border-dark'>";
//        echo "<a href='#' class='btn btn-primary' type='submit' name='personnel-edit'>Edit</a>";
//        echo "<a href='#' class='btn btn-danger' type='submit' name='personnel-delete'>Delete</a>";
        echo "</div>";
        echo "</div>";
    };
}

// Delete an Equipment from the database
function deleteEquipment() {
    global $connection;

    $id = $_POST['id'];


    $query = "DELETE FROM `equipment` WHERE `equipment`.`id` = '$id';";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    if($result) {
        header("Location:../jobsheet/job-sheet-view.php?id='$id'");
        exit();
    }
}


/** -- PASSENGER QUERIES */
// Add Passenger Manifest to Job Sheet
function addPassenger() {
    global $connection;

    $destination = $_POST['destination'];
    $pax = $_POST['pax'];
    $initial = $_POST['initial'];
    $surname = $_POST['surname'];
    $job_id = $_POST['job_id'];

    $query = "INSERT INTO `passenger` (`id`, `destination`, `pax`, `initial`, `surname`, `job_id`) VALUES (NULL, '$destination', '$pax', '$initial', '$surname', '$job_id');";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    if($result) {
        header("Location:passenger-manifest-create.php?id=$job_id");
        exit();
    }
//
}

// Display All Passengers associated with Job Sheet
function displayAllPassenger() {
    echo "<h3>Display here all Passengers</h3>";

    global $connection;

    $id = $_GET['id'];

    $query = "SELECT * FROM `passenger` WHERE `passenger`.`job_id` = '$id'";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };


    while($passenger = mysqli_fetch_assoc($result)) {
    echo "<div class='row'>";
    echo "<div class='col-2 border border-dark'>";
    echo "<label>Destination: </label>";
    echo "<label>" . $passenger['destination'] . "</label>";
    echo "</div>";
    echo "<div class='col-2 border border-dark'>";
    echo "<label>PAX: </label>";
    echo "<label>" . $passenger['pax'] . "</label>";
    echo "</div>";
    echo "<div class='col-2 border border-dark'>";
    echo "<label>Initial: </label>";
    echo "<label>" . $passenger['initial'] . "</label>";
    echo "</div>";
    echo "<div class='col-2 border border-dark'>";
    echo "<label>Surname: </label>";
    echo "<label>" . $passenger['surname'] . "</label>";
    echo "</div>";
    echo "<div class='col-4 border border-dark'>";
//        echo "<a href='#' class='btn btn-primary' type='submit' name='personnel-edit'>Edit</a>";
//        echo "<a href='#' class='btn btn-danger' type='submit' name='personnel-delete'>Delete</a>";
    echo "</div>";
    echo "</div>";
    };
}

// Delete an Passengers from the database
function deletePassenger() {
    global $connection;

    $id = $_POST['id'];


    $query = "DELETE FROM `passenger` WHERE `passenger`.`id` = '$id';";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    if($result) {
        header("Location:../jobsheet/job-sheet-view.php?id='$id'");
        exit();
    }

}


/** -- PERSONNEL QUERIES */
// Add Personnel Hire to Job Sheet
function addPersonnel() {
    global $connection;

    $personnel_type = $_POST['personnel_type'];
    $personnel_hrs = $_POST['personnel_hrs'];
    $personnel_days = $_POST['personnel_days'];
    $job_id = $_POST['job_id'];

    $query = "INSERT INTO `personnel` (`id`, `personnel_type`, `personnel_hrs`, `personnel_days`, `job_id`) VALUES (NULL, '$personnel_type', '$personnel_hrs', '$personnel_days', '$job_id');";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    if($result) {
        header("Location:personnel-hire-create.php?id=$job_id");
        exit();
    }
//
}

// Display All Personnel associated with Job Sheet
function displayAllPersonnel() {
    echo "<h3>Display here all Personnel</h3>";

    global $connection;

    $id = $_GET['id'];

    $query = "SELECT * FROM `personnel` WHERE `personnel`.`job_id` = '$id'";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    while($personnel = mysqli_fetch_assoc($result)) {
        echo "<form action='../personnel/personnel-delete.php' method='post'>";
        echo "<div class='row'>";
        echo "<div class='col-3 border border-dark'>";
        echo "<label>Type: </label>";
        echo "<label>" . $personnel['personnel_type'] . "</label>";
        echo "</div>";
        echo "<div class='col-3 border border-dark'>";
        echo "<label>Hours: </label>";
        echo "<label>" . $personnel['personnel_hrs'] . "</label>";
        echo "</div>";
        echo "<div class='col-3 border border-dark'>";
        echo "<label>Days: </label>";
        echo "<label>" . $personnel['personnel_days'] . "</label>";
        echo "</div>";
        echo "<div class='col-3 border border-dark'>";
//        echo "<a href='#' class='btn btn-primary' type='submit' name='personnel-edit'>Edit</a>";
//        echo "<a href='#' class='btn btn-danger' type='submit' name='personnel-delete'>Delete</a>";
        echo "</div>";
        echo "</div>";
        echo "</form>";
    };

}

// Delete an Personnel from the database
function deletePersonnel() {
    global $connection;

    $id = $_GET['id'];


    $query = "DELETE FROM `personnel` WHERE `personnel`.`id` = '$id'";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

}


/** -- GENERAL QUERIES */
// This query is used to list out all ABWA Vessels for display in <select><option> tags
function abwaVessels() {
    global $connection;
    $query = "SELECT * FROM vessel WHERE 1";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Query failed:' . mysqli_error($connection));
    };

    echo "<label for='vessel' class=\"h5\">ABWA Vessel</label>";
    echo "<select id='vessel' class='form-control form-control-sm' name='vessel'>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<option value='".$row['vessel_code']."'>".$row['vessel_name']."</option>";
    }
    echo "</select>";
}

// This function is used to go back to Job Sheet with correct $id
function goBackToJob() {

    $job_id = $_POST['job_id'];

    header("Location:../jobsheet/job-sheet-view.php?id=$job_id");
    exit();
}

?>
