<?php
/**
 * Created by PhpStorm.
 * User: Cameron
 * Date: 3/12/2018
 * Time: 11:18 AM
 */

include "../private/db/db_connection.php";
include "../private/db/db_queries.php";

if(isset($_POST['create-profile'])) {
    createNewCrew();
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crew Portal</title>

    <link rel="stylesheet" href="../styles/bootstrap-reboot.css">
    <link rel="stylesheet" href="../styles/bootstrap-grid.css">
    <link rel="stylesheet" href="../styles/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
<div class="container">
    <div class="col-12 aligner mb-3">
        <a href="http://www.abwa.com.au/"><img src="../images/abwa_logo.png" style="width: 300px;" alt="ABWA Portals"></a>
        <h1>ABWA Portal</h1>
    </div>

    <div id="profile" class="card card-def mb-5">
        <div class="card-header blue-bkgrd">
            <h2>Register with ABWA</h2>
        </div>
        <div class="card-body">
            <div class="col-12">
                <p>To register your details as a crew in the ABWA database, please insert your details into the following form.</p>
            </div>
            <form class="col-12" action="register.php" method="post">
                <div class="row">
                    <div class="col-4 form-group">
                        <input class="form-control" type="text" name="first_name_crew" placeholder="First Name*">
                    </div>
                    <div class="col-4 form-group">
                        <input class="form-control" type="text" name="last_name_crew" placeholder="Surname*">
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
                        <button class="btn btn-primary btn-lg pl-5 pr-5" type="submit" name="create-profile">Create Crew</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>-->
