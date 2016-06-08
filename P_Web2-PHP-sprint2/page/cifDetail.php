<?php
/*
Author : Yvan Cochet
Summary : Detail of a cif
Date : 01.03.2016
*/

//Includes

include('../class/DbAcces.php');

$dbAcces = new DbAcces();

$dbAcces->connectDB();

session_start();

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
                    <li><a href="./cif.php"><span class="glyphicon glyphicon-th-large">&nbsp;</span>CIFS</a></li>
                    <li><a href="about.php"><span class="glyphicon glyphicon-info-sign">&nbsp;</span>A propos</a></li>
                    <?php
                    if(isset($_SESSION['namPseudo']) AND isset($_SESSION['admin']) AND $_SESSION['admin'] == 1)
                    {
                        ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                                    class="glyphicon glyphicon-plus"></span> &nbsp; Ajouter une CIF</a>

                            <div class="dropdown-menu" id="dropdown-add-cif">
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
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <!--Login dropdown-->
                <?php
                if(!isset($_SESSION['namPseudo']))
                {
                    ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">Se connecter &nbsp;<span class="glyphicon glyphicon-log-in"></span></a>
                            <div class="dropdown-menu" id="dropdownLogin">
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
                                <div class="bottom text-center" id="div-join-us">
                                    <form><a href="#" title="Fast and free sign up!" id="btnNewUser" data-toggle="collapse" data-target="#formRegister">Tu es nouveau ? Rejoins-nous !</a></form>
                                </div>
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
                                    <input name="namURL" type="hidden" <?php echo 'value="'.$URL.'"';?>>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">S'enregistrer</button>
                                    </div>
                                </form>
                            </div>
                        </li>
                    </ul>

                <?php
                }
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
        <!--/NAV-BAR-->

        <!--Principal content detail of the cif-->

        <?php
        //Check if id is existent
        if(isset($_GET['id']))
        {
            $dbAcces->printCifById($_GET['id'],$URL);
        }
        else
        {
            echo 'Error, no id selected';
        }
        ?>

        <!--/Principal content detail of the cif-->

        <!--FOOTER-->
        <footer id="footer">
            <div id="footer-content">
                <p id="footer-text">&copy;ETML Ecole Technique Des Metiers De Lausanne</p>
            </div>
        </footer>
        <!--/FOOTER-->
    </body>
</html>
