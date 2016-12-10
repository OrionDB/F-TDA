<?php
/**
 * Created by PhpStorm.
 * User: baltenspda
 * Date: 03.06.16
 * Summary: This page will process the register request from the user
 */

// Include all the class we need
include("Class/DbAccess.php");

//Creating a work variable
$dba = new DbAccess();

// Check if information are entered
if(isset($_POST['userName']) AND isset($_POST['userPassword'])){

    // Call the function for adding a member
    $dba->Login();

    // Return to main page
    header("location: forums.php");
}else{

    // Error message
    echo '<body onLoad="alert(\'Toutes les informations ne sont pas correctement entrées.\')"> ';
    // Return to main page
    echo '<meta http-equiv="refresh" content="0;URL=forums.php">';
}