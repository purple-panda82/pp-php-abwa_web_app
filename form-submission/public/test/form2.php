<?php
/**
 * Created by PhpStorm.
 * User: Cameron
 * Date: 11/12/2018
 * Time: 9:29 AM
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
                <div class="row">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="launch_master" name="launch_master">
                        <label class="form-check-label" for="launch_master">Launch Master</label>
                        <input class="form-control" type="file" name="launch_master_card" placeholder="Upload Launch Master's Card">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="lines_boat_master_inner" name="lines_boat_master_inner">
                        <label class="form-check-label" for="lines_boat_master_inner">Lines Boat - Inner</label>
                        <input class="form-control" type="file" name="lines_boat_master_inner_card">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="lines_boat_master_outer" name="lines_boat_master_outer">
                        <label class="form-check-label" for="lines_boat_master_outer">Lines Boat - Outer</label>
                        <input class="form-control" type="file" name="lines_boat_master_outer_card">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="deck_hand_launch" name="deck_hand_launch">
                        <label class="form-check-label" for="deck_hand_launch">Deck Hand - Launch</label>
                        <input class="form-control" type="file" name="deck_hand_launch_card">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="deck_hand_lines_boat" name="deck_hand_lines_boat">
                        <label class="form-check-label" for="deck_hand_lines_boat">Deck Hand - Lines Boat</label>
                        <input class="form-control" type="file" name="deck_hand_lines_boat_card">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="msic_card" name="msic">
                        <label class="form-check-label" for="msic_card">MSIC Card</label>
                        <input class="form-control" type="file" name="msic_card">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="basic_rigger" name="basic_rigger">
                        <label class="form-check-label" for="basic_rigger">Basic Rigger Card</label>
                        <input class="form-control" type="file" name="basic_rigger_card">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="dogman" name="dogman">
                        <label class="form-check-label" for="dogman">Dogman</label>
                        <input class="form-control" type="file" name="dogman_card">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="cv_or_cv_crane" name="cv_or_cv_crane">
                        <label class="form-check-label" for="cv_or_cv_crane">CV or CV Crane</label>
                        <input class="form-control" type="file" name="cv_or_cv_crane_card">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-primary btn-lg pl-5 pr-5" type="submit" name="submit-cards">Submit</button>
                    </div>
                </div>
            <div class="form-control">
                <input type="hidden" name="first_name_crew" value="<?php echo $_POST['first_name_crew']; ?>">
                <input type="hidden" name="last_name_crew" value="<?php echo $_POST['last_name_crew']; ?>">
                <input type="hidden" name="mobile_crew" value="<?php echo $_POST['mobile_crew']; ?>">
                <input type="hidden" name="email_crew" value="<?php echo $_POST['email_crew']; ?>">
                <input type="hidden" name="password_crew" value="<?php echo $_POST['password_crew']; ?>">
            </div>
            <div class="form-control">
                <input type="submit" name="submit" value="Finalise Profile">
            </div>
        </div>
    </form>
</div>
</body>
</html>
