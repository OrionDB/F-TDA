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
if(isset($_POST['Post'])){

    //echo $_SESSION['namPseudo']."<br>";
    //echo $_POST['Post']."<br>";
    //echo $_POST['topicId']."<br>";

    $text = str_replace("[i]","<i>",$_POST['Post']);
    $text = str_replace("[/i]","</i>",$text);
    $text = str_replace("[/u]","</u>",$text);
    $text = str_replace("[u]","<u>",$text);
    $text = str_replace("[b]","<b>",$text);
    $text = str_replace("[/b]","</b>",$text);
    $text = str_replace("[color = \"","<span style=\"color: ",$text);
    $text = str_replace("\"]","\">",$text);
    $text = str_replace("[/color]","</span>",$text);

    //style=\"color: $color;\"


    $dba->addPost($_SESSION['namPseudo'],$text,$_POST['topicId']);
    // Return to main page
    header("location: forums.php");
}else{
    // Return to main page
    header("location: forums.php");
}