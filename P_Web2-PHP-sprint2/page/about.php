<?php

/*
Author : Yvan Cochet
Date : 19.01.2016
Summary : Website model for P_Web2
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

?>

<!DOCTYPE html>
<html>

    <head lang="fr">
        <!--Links for CSS, javascript, bootstrap-->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/css-perso.css" rel="stylesheet">
        <meta charset="UTF-8">
        <title>Accueil</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <link rel="icon" href="../pictures/favicon.ico" />
    </head>

    <body>
        <h1>Choses interessantes à faire</h1>

        <!--NAV-BAR-->
        <nav class="navbar navbar-inverse">
            <!--Button for responsive design-->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <li><a href="../index.php"><span class="glyphicon glyphicon-home">&nbsp;</span>Accueil</a></li>
                    <li><a href="cif.php"><span class="glyphicon glyphicon-th-large">&nbsp;</span>CIFS</a></li>
                    <li class="active"><a href="about.php"><span class="glyphicon glyphicon-info-sign">&nbsp;</span>A propos</a></li>

                    <?php
                    //If the user logged is an admin, show add cif button
                    if(isset($_SESSION['namPseudo']) AND isset($_SESSION['admin']) AND $_SESSION['admin'] == 1)
                    {
                        ?>
                        <!--button to add a cif-->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                                    class="glyphicon glyphicon-plus"></span> &nbsp; Ajouter une CIF</a>

                            <div class="dropdown-menu" id="dropdown-add-cif">

                                <!--Form to add a cif-->
                                <form class="form" method="post" action="addCif.php"
                                      accept-charset="UTF-8">

                                    <div class="form-group">
                                        <input name="title" type="text" class="form-control"
                                               placeholder="Titre de la CIF" maxlength="25">
                                    </div>

                                    <div class="form-group">
                                        <textarea name="description" class="form-control" rows="12"
                                                  placeholder="Contenu de la CIF"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group-btn">
                                            <select class="form-control" name="category">
                                                <option value="autre">Catégorie</option>
                                                <option value="amis">Amis</option>
                                                <option value="famille">Famille</option>
                                                <option value="professionnel">Professionnel</option>
                                                <option value="nsfw">NSFW</option>
                                                <option value="autre">Autre</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
                                    </div>

                                </form>
                                <!--END Form to add a cif-->

                            </div>

                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <!--Login dropdown-->
                <?php
                //If a user isn't logged, display button to login and register
                if(!isset($_SESSION['namPseudo']))
                {
                    ?>
                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown">

                            <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">Se connecter &nbsp;<span class="glyphicon glyphicon-log-in"></span></a>

                            <div class="dropdown-menu" id="dropdownLogin">

                                <!--Form to login-->
                                <form id="formLogin" method="post" action="login.php" class="form">

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="namPseudo" placeholder="Nom d'utilisateur" required="">
                                    </div>

                                    <div class="form-group" >
                                        <input type="password" class="form-control" name="namPassword" placeholder="Mot de passe" required="">

                                    </div>

                                    <div>
                                        <input name="namURL" type="hidden" <?php echo 'value="'.$URL.'"';?>>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                                    </div>

                                </form>
                                <!--END Form to login-->

                                <div class="bottom text-center" id="div-join-us">
                                    <form><a href="#" title="Fast and free sign up!" id="btnNewUser" data-toggle="collapse" data-target="#formRegister">Tu es nouveau ? Rejoins-nous !</a></form>
                                </div>

                                <!--Form to register-->
                                <form method="post" action="addMemberProcess.php" id="formRegister" class="form collapse">

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="namPseudom" placeholder="Nom d'utilisateur" required="">
                                    </div>

                                    <div class="form-group" >
                                        <input type="password" class="form-control" name="namPasswordm" placeholder="Mot de passe" required="">

                                    </div>

                                    <div class="form-group" >
                                        <input type="password" class="form-control" name="namPassword2" placeholder="Confirmer mot de passe" required="">
                                    </div>

                                    <!--Hidden input with url of the current page in it-->
                                    <input name="namURL" type="hidden" <?php echo 'value="'.$URL.'"';?>>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">S'enregistrer</button>
                                    </div>
                                </form>
                                <!--END Form to register-->
                            </div>
                        </li>

                    </ul>

                <?php
                }
                //Else, write name of the current user and add disconnect button
                else
                {
                    $name = $_SESSION['namPseudo'];
                    ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href='#'><span class="nav navbar-nav navbar-right">&nbsp;</span><?php echo $name; ?></a></li>
                        <li><a href="logout.php"><span class="nav navbar-nav navbar-right">&nbsp;</span>Se déconnecter</a></li>
                    </ul>
                <?php
                }
                ?>
                <!--/login dropdown-->
            </div>
        </nav>
        <!--END NAV-BAR-->

        <!--Principal content, informations about developpers-->

        <div class="principal-content">

            <div class="about-container">

                <h2 >Informations sur les développeurs</h2>

                <!--Same div as CIF to keep the same design-->
                <div class="cif">
                    <h4 class="cif-title">Yvan Cochet</h4>
                    <p class="info-container">
                        Mail : <a href="mailto:cochetyv@etml.educanet.ch">cochetyv@etml.educanet.ch</a><br/>
                        Addresse : Chenalette 3B<br/>
                        CP : 1197 <br/>
                        Ville : Prangins<br/>
                        Téléphone : 079 431 92 71<br/>
                    </p>
                </div>

                <div class="cif">
                    <h4 class="cif-title">Daniel Baltensperger</h4>
                    <p class="info-container">
                        Mail : <a href="mailto:baltenspeda@etml.educanet.ch">baltenspda@etml.educanet.ch</a><br/>
                        Addresse : Rue du Martinet 11Bis<br/>
                        CP : 1188 <br/>
                        Ville : Gimel<br/>
                        Téléphone : +41 79 367 29 12 <br/>
                    </p>
                </div>

                <div class="cif">
                    <h4 class="cif-title">Emmanuel Muller</h4>
                    <p class="info-container">
                        Mail : <a href="mailto:mullerem@etml.educanet.ch">mullerem@etml.educanet.ch</a><br/>
                        Addresse : Rue St-Laurent 2<br/>
                        CP : 1176<br/>
                        Ville : St-Livres<br/>
                        Téléphone : 078 662 45 41<br/>
                    </p>
                </div>

            </div>

        </div>
        <!--END Principal content, informations about developpers-->

        <!--FOOTER-->
        <footer id="footer">
            <div id="footer-content">
                <p id="footer-text">&copy;ETML Ecole Technique Des Metiers De Lausanne</p>
            </div>
        </footer>
        <!--END FOOTER-->
    </body>
</html>