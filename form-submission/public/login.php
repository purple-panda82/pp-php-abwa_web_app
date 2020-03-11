<?php
/**
 * Created by PhpStorm.
 * User: Cameron
 * Date: 3/12/2018
 * Time: 11:18 AM
 */
include "../private/db/db_connection.php";
include "../private/db/db_queries.php";

if(isset($_POST['login'])) {
    loginValidate();
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
            <h2>Log In</h2>
        </div>
        <div class="card-body">
            <div class="col-12">
                <p>Please insert your email and password to log-in.</p>
            </div>
            <form class="col-12" action="login.php" method="post">
                <div class="row">
                    <div class="col-8 form-group">
                        <input class="form-control" type="text" name="email_crew" placeholder="Type in your Email" value="example@mail.com">
                    </div>
                    <div class="col-4 form-group">
                        <input class="form-control" type="password" name="password_crew" placeholder="Password*">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <p>Haven't yet registered as an ABWA Crew, <a href="register.php">click here to register</a></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-primary btn-lg pl-5 pr-5" type="submit" name="login">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>