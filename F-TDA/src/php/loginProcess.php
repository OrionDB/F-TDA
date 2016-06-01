<?php
/*
Author : Yvan Cochet
Summary : Page to process login of the user
Date : 20.04.2016
*/

//Include page class and create new dbAccess object
include('Class/DbAccess.php');
$dbAccess = new DbAccess();


//If all the form is full
if(isset($_POST['username']) AND $_POST['username']!== '' AND isset($_POST['password']) AND $_POST['password'] !== '' )
{

            $password = $_POST['password'];
            $username = $_POST['username'];

            //Check login information
            $isCheck = $dbAccess->login($username, $password);

            //If login informations are checked
            if($isCheck)
            {
                //Start session
                session_start();

                //Store username in $_SESSION
                $_SESSION['username'] = $username;

                // Return to home page
                header("location: forums.php");
            }
            else
            {
                //If information aren't checked, error and return to form
                echo "<h1>Nom d'utilisateur ou mot de passe incorrecte</h1>";
                echo '<meta http-equiv="refresh" content="2;URL=./login.php">';
            }



}
else
{
    echo '<h1>Formulaire vide ou incomplet, veuillez le remplir</h1>';
    echo '<META HTTP-EQUIV="Refresh" CONTENT="3; URL=forums.php">';
}
