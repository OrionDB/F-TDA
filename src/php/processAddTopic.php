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
if(isset($_POST['Post']) AND isset($_POST['Title'])){

    //print_r($_POST);

    $Title = addslashes($_POST['Title']);
    $Post = addslashes($_POST['Post']);

    $topic = $dba->createTopic($Title,$_POST['forum'],$_SESSION['namPseudo'],$Post);

    $URL = "topic.php?id=".$topic."&name=".$_POST['Title'];

    header("location: $URL");
}else{
    // Return to main page
    header("location: forums.php");
}