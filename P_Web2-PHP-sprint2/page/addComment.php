<?php
/*
Author : Yvan Cochet
Summary : Treatement to add a comment
Date : 19.04.2016
*/

//Includes
include('../class/DbAcces.php');

//New DbAcces object
$dbAcces = new DbAcces();

//Use connectDB method
$dbAcces->connectDB();

//Start session
session_start();

//Set the url of the current page in $_SESSION
$URL = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$_SESSION['URL'] = $URL;

//If all the post isn't empty and exists, use method to add a comment
if(isset($_POST['comment']) AND isset($_POST['evaluation']) AND $_POST['evaluation'] !== '' AND isset($_POST['idCif']) AND $_POST['idCif'] !== '')
{
    $dbAcces->addComment($_POST['comment'], $_POST['evaluation'], $_SESSION['namPseudo'], $_POST['idCif']);
}

?>


