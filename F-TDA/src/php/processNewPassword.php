<?php
/**
 * Created by PhpStorm.
 * User: baltenspda
 * Date: 03.06.16
 * Summary: This page will process the register request from the user
 */

// Include all the class we need
include("Class/DbAccess.php");

session_start();

//Creating a work variable
$dba = new DbAccess();

// Check if information are entered
if(isset($_POST['iPassworda']) AND isset($_POST['iPassword']) AND isset($_POST['iPassword2'])){

    $dba->setNewPassword($_SESSION['namPseudo']);



}else{

    // Error message
    echo '<body onLoad="alert(\'Toutes les informations ne sont pas correctement entrées.\')"> ';
    // Return to main page
    echo '<meta http-equiv="refresh" content="0;URL=myProfile.php">';
}