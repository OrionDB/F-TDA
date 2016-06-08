<?php
/*
Author : Yvan Cochet
Summary : Page to process adding a cif
Date : 15.03.2016
*/

//Includes
include('../class/DbAcces.php');

//New dbAccess object
$dbAcces = new DbAcces();

//Use connectDB method
$dbAcces->connectDB();

//Start the session
session_start();

//If all the post exist and isn't empty, use method to add a cif
if(isset($_POST['title']) AND isset($_POST['category']) AND isset($_POST['description']) AND $_POST['title']!='' AND $_POST['category'] !='' AND $_POST['description']!='')
{
    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $pseudo = $_SESSION['namPseudo'];

    $dbAcces->addCif($title,$description,$pseudo,$category);

}
?>

<!--Redirect to indexe-->
<meta http-equiv="refresh" content="0;URL=../index.php">