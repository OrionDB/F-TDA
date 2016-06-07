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
if(isset($_POST['iPseudo']) AND isset($_POST['iMail'])){

    if($_POST['iPseudo'] == ""){
        $_POST['iPseudo'] == $_POST['iPseudoh'];
    }

    if($_POST['iMail'] == ""){
        $_POST['iMail'] == $_POST['iMailh'];
    }

    if($_POST['iVarious'] == ""){
        $_POST['iVarious'] == $_POST['iVarioush'];
    }

    // Call the function for adding a member
    $id = $dba->getIdMember($_POST['iPseudoh']);

    $dba->updateMember($_POST['iPseudo'],$_POST['iMail'],$_POST['iVarious'],$id[0]['idMember']);

    echo '<body onLoad="alert(\'Information sauvée\')"> ';
    // Return to main page
    echo '<meta http-equiv="refresh" content="0;URL=myProfile.php">';
}else{

    // Error message
    echo '<body onLoad="alert(\'Toutes les informations ne sont pas correctement entrées.\')"> ';
    // Return to main page
    echo '<meta http-equiv="refresh" content="0;URL=forums.php">';
}