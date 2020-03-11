<?php
/**
 * Created by PhpStorm.
 * User: Cameron
 * Date: 11/12/2018
 * Time: 9:21 AM
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form input Test</title>

    <link rel="stylesheet" href="../../styles/bootstrap-reboot.css">
    <link rel="stylesheet" href="../../styles/bootstrap-grid.css">
    <link rel="stylesheet" href="../../styles/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles.css">
</head>
<body>
<div class="container">
    <form action="form2.php" method="post">
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
                <button class="btn btn-primary btn-lg pl-5 pr-5" type="submit" name="submit-profile">Add Your Cards</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
