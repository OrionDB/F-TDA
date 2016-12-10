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
if(isset($_POST['desc']) AND isset($_POST['Name']) AND isset($_POST['own'])){

    //print_r($_POST);

    $name = addslashes($_POST['Name']);
    $desc = addslashes($_POST['desc']);

    //print_r($_POST);

    $topic = $dba->createForum($_POST['Name'],$_POST['desc'],$_POST['own'],$_POST['acc']);

    $URL = "forum.php?id=".$_POST['Name'];

    //http://127.0.0.1/projects/F-TDA/src/php/forum.php?id=Star%20Trek%20Online
    //http://127.0.0.1/projects/F-TDA/src/php/forum.php?id=25&name=ArmA%20III

    header("location: $URL");
}else{
    // Return to main page
    header("location: forums.php");
}