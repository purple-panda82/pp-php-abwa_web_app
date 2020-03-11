<?php
/**
 * Created by PhpStorm.
 * User: Cameron
 * Date: 3/12/2018
 * Time: 11:18 AM
 */


    $connection = mysqli_connect('localhost', 'root', '', 'form-submission');

    if (!$connection) {
        die("DB not connected");
    }


?>