<?php

//Start our session.
session_start();

//Expire the session if user is inactive for 30
//minutes or more.
$expireAfter = 1800;

//Check to see if our "last action" session
//variable has been set.
if(isset($_SESSION['last_action'])){

    //Figure out how many seconds have passed
    //since the user was last active.
    $secondsInactive = time() - $_SESSION['last_action'];

    //Convert our minutes into seconds.
    $expireAfterSeconds = $expireAfter ;

    //Check to see if they have been inactive for too long.
    if($secondsInactive >= $expireAfterSeconds){
        //User has been inactive for too long.
        //Kill their session.
        session_unset();
        session_destroy();
        header('location:index.php');
    }

}

//Assign the current timestamp as the user's
//latest activity
$_SESSION['last_action'] = time();
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 31/08/2018
 * Time: 16:15
 */