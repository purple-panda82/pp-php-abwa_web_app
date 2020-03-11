<?php
/**
 * Created by PhpStorm.
 * User: Cameron
 * Date: 11/12/2018
 * Time: 9:34 AM
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
    <form action="form_process.php" method="post">
        <div class="form-group">
            <div class="form-control">
                <input type="text" name="name_on_card">
            </div>
            <div class="form-control">
                <input type="text" name="credit_card_number">
            </div>
            <div class="form-control">
                <input type="text" name="credit_card_expiration_date">
            </div>
            <div class="form-control">
                <input type="hidden" name="membership" value="<?php echo $_POST['membership']; ?>">
            </div>
            <div class="form-control">
                <input type="hidden" name="terms_and_conditions" value="<?php echo $_POST['terms_and_conditions']; ?>">
            </div>
            <div class="form-control">
                <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
                <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
            </div>
            <div class="form-control">
                <input type="submit" name="submit" value="Finish">
            </div>
        </div>
    </form>
</div>
</body>
</html>
