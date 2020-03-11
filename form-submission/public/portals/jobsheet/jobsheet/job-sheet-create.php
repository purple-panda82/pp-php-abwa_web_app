<?php
/**
 * Created by PhpStorm.
 * User: Cameron
 * Date: 3/12/2018
 * Time: 11:18 AM
 */
include "../../../../private/db/db_connection.php";
include "../../../../private/db/db_queries.php";

$crew_id = $_COOKIE['user'];

if(isset($_POST['create-jobsheet'])) {
    createNewJobSheet();
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Sheet Portal</title>

    <link rel="stylesheet" href="../../../../styles/bootstrap-reboot.css">
    <link rel="stylesheet" href="../../../../styles/bootstrap-grid.css">
    <link rel="stylesheet" href="../../../../styles/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../../styles.css">
</head>
<body>
<div class="container">
    <div class="col-12 aligner mb-3">
        <img src="../../../../images/abwa_logo.png" style="width: 300px;" alt="ABWA Portals">
        <h1>Job Sheet Portal</h1>
    </div>

    <div id="jobsheet" class="card card-def mb-5">
        <div class="card-header blue-bkgrd">
            <h2>Create a New Job Sheet</h2>
        </div>
        <div class="card-body">
            <div class="col-12">
                <p>To create a new job sheet, please input the details into the form fields below then click 'Submit' button</p>
            </div>
            <form class="col-12" action="job-sheet-create.php" method="post">
                <div class="row mb-3">
                    <div class="col-12 form-group">
                        <label for="abwa-job-no" class="h5">ABWA JOB NUMBER</label>
                        <input id="abwa-job-no" class="form-control" type="text" name="job_id" placeholder="ABWA Job Number">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 form-group">
                        <label for="job-date" class="h5">DATE<br><span class="text-muted h6">(Will Be Formatted DD/MM/YY)</span></label>
                        <input class="form-control" type="text" name="date" id="job-date">
                    </div>
                    <div class="col-4 form-group">
                        <label for="start-time" class="h5">START TIME<br><span class="text-muted h6">(Will Be Formatted as 24HRS)</span></label>
                        <input class="form-control" type="text" name="start_time" id="start-time">
                    </div>
                    <div class="col-4 form-group">
                        <label for="end-time" class="h5">END TIME<br><span class="text-muted h6">(Will Be Formatted as 24HRS)</span></label>
                        <input class="form-control" type="text" name="end_time" id="end-time">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 form-group">
                        <label for="port-origin" class="h5">PORT OF ORIGIN</label>
                        <select id="port-origin" name="port_of_origin">
                            <option value="AMC">AMC</option>
                            <option value="FREMANTLE">FREMANTLE</option>
                            <option value="KWINANA">KWINANA</option>
                        </select>

                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 form-group">
                        <?php abwaVessels(); ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 form-group">
                        <label for="master" class="h5">MASTER</label>
                        <?php displayAllCrewAsList(); ?>
                    </div>
                    <div class="col-4 form-group">
                        <label for="crew1" class="h5">CREW 1</label>
                        <input id="crew1" class="form-control" type="text" name="job_crew1" placeholder="Crew 1">
                    </div>
                    <div class="col-4 form-group">
                        <label for="crew2" class="h5">CREW 2</label>
                        <input id="crew2" class="form-control" type="text" name="job_crew2" placeholder="Crew 2">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 form-group">
                        <?php selectAgency(); ?>
                    </div>
                    <div class="col-4 form-group">
                        <label for="authorised-by" class="h5">AUTHORISED BY</label><br>
                        <small class="h6 text-muted">If authorised by an Agent, then type in their name here.</small>
                        <input id="authorised-by" class="form-control h5" type="text" name="authorised_by" value="VOYAGER">
                    </div>
                    <div class="col-4 form-group">
                        <label for="purchase-order" class="h5">PURCHASE ORDER</label>
                        <input id="purchase-order" class="form-control" type="text" name="purchase_order" placeholder="Purchase Order#">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 form-check form-check-inline">
                        <label for="attending" class="mr-5 h5">ATTENDING</label>
                        <input class="form-check-input" type="radio" name="attending" value="FACILITY"><span class="h6 mr-3">FACILITY</span>
                        <input class="form-check-input" type="radio" name="attending" value="PLATFORM"><span class="h6 mr-3">PLATFORM</span>
                        <input class="form-check-input" type="radio" name="attending" value="SHIP"><span class="h6 mr-3">SHIP</span>
                        <input class="form-control" type="text" name="attending_ship" placeholder="PLEASE TYPE IN THE SHIP'S NAME">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-2 form-check">
                        <label for="outside-limit" class="h5">OUTSIDE PORT LIMITS</label>
                        <input id="outside-limit" class="form-check-input" type="radio" name="outside_limit" value="YES"><span class="h6 mr-3">YES</span><br>
                        <input id="outside-limit" class="form-check-input" type="radio" name="outside_limit" value="NO"><span class="h6 mr-3">NO</span>
                    </div>
                    <div class="col-3 form-group">
                        <label for="inner-harbour" class="h5">INNER HARBOUR</label><br>
                        <input type="checkbox" id="inner-harbour" name="inner_habour"><span class="h6 mr-3">FREMANTLE</span>
                    </div>
                    <div class="col-3">
                        <label for="outer-harbour" class="h5">OUTER HARBOUR</label><br>
                        <input id="outer-harbour" type="radio" name="outer_habour" value="AMC"><span class="h6 mr-3">AMC</span>
                        <input id="outer-harbour" type="radio" name="outer_habour" value="ALCOA"><span class="h6 mr-3">ALCOA</span>
                        <input id="outer-harbour" type="radio" name="outer_habour" value="KGJ"><span class="h6 mr-3">KGJ</span><br>
                        <input id="outer-harbour" type="radio" name="outer_habour" value="JB"><span class="h6 mr-3">JB</span>
                        <input id="outer-harbour" type="radio" name="outer_habour" value="KBB"><span class="h6 mr-3">KBB</span>
                        <input id="outer-harbour" type="radio" name="outer_habour" value="ORJ"><span class="h6 mr-3">ORJ</span>
                    </div>
                    <div class="col-2">
                        <label for="anchorage" class="h5">ANCHORAGE</label><br>
                        <input id="anchorage" type="radio" name="anchorage" value="GR"><span class="h6 mr-2">GR</span>
                        <input id="anchorage" type="radio" name="anchorage" value="OPL"><span class="h6 mr-3">OPL</span><br>
                        <input id="anchorage" type="radio" name="anchorage" value="ORA"><span class="h6 mr-3">ORA</span>
                        <input id="anchorage" type="radio" name="anchorage" value="ORAN"><span class="h6 mr-3">ORAN</span>
                    </div>
                    <div class="col-2">
                        <label for="berth-anchorage" class="h5">BERTH OR ANCHORAGE</label>
                        <input id="berth-anchorage" class="form-control" type="text" name="berth_anchorage" placeholder="(No# or Letter)">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 form-group">
                        <label for="transfer" class="h5">TRANSFER</label><br>
                        <input type="checkbox" name="transfer_personnel" value="PERSONNEL"><span class="h6 mr-3">PERSONNEL</span>
                        <input type="checkbox" name="transfer_pilot" value="PILOT"><span class="h6 mr-3">PILOT</span>
                    </div>
                    <div class="col-4 form-group">
                        <label for="lines-boat" class="h5">LINES BOAT</label><br>
                        <input id="lines-boat" type="radio" name="lines_boat" value="ONE"><span class="h6 mr-3">1</span>
                        <input id="lines-boat" type="radio" name="lines_boat" value="FWD"><span class="h6 mr-3">FWD</span>
                        <input id="lines-boat" type="radio" name="lines_boat" value="AFT"><span class="h6 mr-3">AFT</span>
                    </div>
                    <div class="col-4 form-group">
                        <label for="drill" class="h5">DRILL</label><br>
                        <input id="drill" type="checkbox" name="drill_frc" value="FRC"><span class="h6 mr-3">FRC</span>
                        <input id="drill" type="checkbox" name="drill_lifeboat" value="LIFEBOAT"><span class="h6 mr-3">LIFEBOAT</span>
                        <input id="drill" type="checkbox" name="drill_other" value="OTHER"><span class="h6 mr-3">OTHER</span>
                        <input id="drill" type="text" name="drill_other_type" placeholder="IF OTHER IS SELECTED, SPECIFY DRILL">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 form-group">
                        <label for="comments" class="h5">COMMENTS AND NOTES</label>
                        <textarea id="comments" class="form-control" name="comments" rows="4" cols="50" placeholder="Please start typing in any comments or notes that needs to be recorded. These notes will be converted to uppercase upon saving."></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-primary btn-lg pl-5 pr-5" type="submit" name="create-jobsheet">Initialize Job Sheet</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <footer class="col-12 mt-5">
        <a class='btn btn-primary btn-lg blue-bkgrd' href='../../../portals/crew/profile/crew-view.php?id=<?php echo $crew_id ?>'><h2>Go Back</h2></a>
        <a class="btn btn-primary blue-bkgrd" href="http://www.abwa.com.au/"><h2>ABWA Website</h2></a>
    </footer>
</div>
</body>
</html>
