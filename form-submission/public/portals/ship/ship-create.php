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

if(isset($_POST['create-ship'])) {
    createNewShip();
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ship Portal</title>

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
        <h1>Ship Portal</h1>
    </div>

    <div id="profile" class="card card-def mb-5">
        <div class="card-header blue-bkgrd">
            <h2>Create a New Ship</h2>
        </div>
        <div class="card-body">
            <div class="col-12">
                <p>Please use the following fields to add a new ship to the ABWA Database</p>
            </div>
            <form class="col-12" action="ship-create.php" method="post">
                <div class="row">
                    <div class="col-6 form-group">
                        <input class="form-control" type="text" name="imo_number" placeholder="Ship's IMO Number">
                    </div>
                    <div class="col-6 form-group">
                        <input class="form-control" type="text" name="ship_name" placeholder="Ship's Name">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 form-group">
                        <?php selectAgency(); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-primary btn-lg pl-5 pr-5" type="submit" name="create-ship">Create Ship</button>
                        <a class='btn btn-primary btn-lg' href='../../portals/crew/profile/crew-view.php?id=<?php echo $crew_id ?>'>Go Back</a>
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
