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

if(isset($_POST['Post'])){
    $text = $dba->translateBBCode($_POST['Post']);

    $post = addslashes($text);

    $dba->editPostById($_POST['id'],$post);
}
    $URL = $_POST['URL']."&name=".$_POST['name'];


    //print $URL;

    //// Return to main page
    header("location: $URL");