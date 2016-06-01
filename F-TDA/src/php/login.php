<?php
/*
Author : Yvan Cochet
Summary : page with the form to log in
Date : 20.04.2016
*/

//Include page class and create new dbAccess object
include('../class/dbAccess.php');
$dbAccess = new dbAccess();

//Start the session to get $_SESSION
session_start();


?>

<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8"/>
        <link rel="stylesheet" media="all" href="../../resource/css/style.css"/>
        <script type="text/javascript" src="../js/js-perso.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <title>
            Connexion
        </title>
    </head>
    <body>

        <?php
        //Include header and menu to the page
        include('../html/header.html');
        include('../html/menu.php');

        ?>

        <div id="container">

            <h2>Connexion</h2>

            <!--Form to log in -->
            <form method="post" action="loginProcess.php">

                <!--Username-->
                <input type="text" placeholder="Nom d'utilisateur" name="username" class="input-text">
                <br/><br/>

                <!--Password-->
                <input type="password" placeholder="Mot de passe" name="password" class="input-text">
                <br/><br/>

                <!--Recaptcha-->
                <div class="g-recaptcha" data-sitekey="6LdJ3R0TAAAAAPygvVyGNL1prWn2rfkC_8I0yt-0"></div>
                <br/><br/>

                <!--Button-->
                <input type="submit" value="Se connecter" class="button-submit">

            </form>
            <!--END form-->

        </div>

        <?php
        //Include footer
        include('../html/footer.html');
        ?>

    </body>
</html>
