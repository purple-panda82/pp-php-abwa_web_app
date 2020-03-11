<?php
/**
 * Created by PhpStorm.
 * User: Cameron
 * Date: 3/12/2018
 * Time: 11:18 AM
 */
include "../../../private/db/db_connection.php";
include "../../../private/db/db_queries.php";

$id = $_COOKIE['user'];

if(isset($_POST['create_agent'])) {
    createNewAgent();
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agent Portal</title>

    <link rel="stylesheet" href="../../../styles/bootstrap-reboot.css">
    <link rel="stylesheet" href="../../../styles/bootstrap-grid.css">
    <link rel="stylesheet" href="../../../styles/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../styles.css">
</head>
<body>
<div class="container">
    <div class="col-12 aligner mb-3">
        <img src="../../../images/abwa_logo.png" style="width: 300px;" alt="ABWA Portals">
        <h1>Agent Portal</h1>
    </div>

    <div id="agent" class="card card-def mb-5">
        <div class="card-header blue-bkgrd">
            <h2>Create a New Agent</h2>
        </div>
        <div class="card-body">
            <div class="col-12">
                <p>Please enter the Agent Details into the form below</p>
            </div>
            <form class="col-12" action="agent-create.php" method="post">
                <div class="row">
                    <div class="col-4 form-group">
                        <input class="form-control" type="text" name="agency_name" placeholder="Agent Name*">
                    </div>
                    <div class="col-4 form-group">
                        <input class="form-control" type="text" name="agency_code" placeholder="Agent's Code">
                    </div>
                    <div class="col-4 form-group">
                        <input class="form-control" type="text" name="contact_name" placeholder="Best Contact">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p>Agent's Contact Details</p>
                    </div>
                    <div class="col-8 form-group">
                        <input class="form-control" type="email" name="contact_email" placeholder="Agent's Email">
                    </div>
                    <div class="col-4 form-group">
                        <input class="form-control" type="text" name="contact_phone" placeholder="Best Contact Number">
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-primary btn-lg pl-5 pr-5" type="submit" name="create_agent">Create Agent</button>
                        <a class='btn btn-primary btn-lg' href='../../portals/crew/profile/crew-view.php?id=<?php echo $id ?>'>Go Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <footer class="col-12 mt-5">
        <a type='button' class='btn btn-primary mr-2' href='../crew/profile/crew-view.php?id=<?php echo $id;?>'>
            <h2><i class="fas fa-tachometer-alt mr-4"></i>Dashboard</h2>
        </a>
    </footer>
</div>
</body>
</html>
