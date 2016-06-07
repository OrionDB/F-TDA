<?php
/**
 * Created by PhpStorm.
 * User: baltenspda
 * Date: 01.06.16
 * Summary : This page allow a visitor to register in the forum for post in the forum and access to certain other forum
 */
?>
<!DOCTYPE html>
<html>

<?php
session_start();
?>

	<!-- Start Header -->
	<head>
		<title>Forum Officiel team d'Ares</title>
		<meta http-equiv="content-language" content="fr-ch" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="author" content="Sadhana Ganapathiraju, Daniel Baltensperger" />
		<meta name="design" content="Sadhana Ganapathiraju, Daniel Baltensperger" />
		<meta name="description" content="This is the new forum of the TDA" />

		<!-- CSS and JS link -->
		<link rel="stylesheet" type="text/css" media="screen" href="../../resources/css/screen.css" />
	</head>
	<!-- End Header -->

    <!-- Start Body -->
<body class="bProfile">
        <?php include("_Layout/layout_header.php") ?>

            <!-- Start Navigation bar -->
        <?php include("_Layout/layout_menu.php") ?>
            <!-- End Navigation bar -->

        <?php
            include("Class/DbAccess.php");
            $work = new DbAccess();

            print_r($_SESSION);

            $me = $work->getMemberByName($_SESSION['namPseudo']);
            echo "<br><br>";
            print_r($me);

        ?>


		<div class="wrapper">
		  <div class="content-wrapper">
			<div class="content">
			  <h4>Mon Profil</h4>

			  <!-- Start First List 1 columns -->

                <form class="registerForm" method="post" action="processSaveProfil.php">

                    <!-- Hidden input for check if the value was changed during the process -->
                    <input type="hidden" name="iPseudoh" value='<?php echo $me[0]['memPseudo'] ?>'>
                    <input type="hidden" name="iMailh" value='<?php echo $me[0]['memMail'] ?>'>
                    <input type="hidden" name="iVarioush" value='<?php echo $me[0]['memVarious'] ?>'>

                    <table>
                        <tr>
                            <th>Pseudo</th>
                            <td><input name ="iPseudo" type="text" value='<?php echo $me[0]['memPseudo'] ?>'></td>
                        </tr>
                        <tr>
                            <th>Adresse Mail</th>
                            <td><input type="email" name="iMail" value='<?php echo $me[0]['memMail'] ?>'></td>
                        </tr>
                        <tr>
                            <th>Divers</th>
                            <td><textarea name="iVarious"><?php echo $me[0]['memVarious'] ?></textarea></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td><input type="submit" value="Enregistrer"></td>
                        </tr>
                    </table>
                    <br>
                    <br>
                </form>
                <h4>Changer Mot de Passe</h4>
                <form class="registerForm" method="post" action="#">
                    <table>
                        <tr>
                            <th>Mot de passe</th>
                            <td><input name="iPassword" type="password"></td>
                        </tr>
                        <tr>
                            <th>Répéter le Mot de passe</th>
                            <td><input name="iPassword2" type="password"></td>
                        </tr>

                        <tr>
                            <th></th>
                            <td><input type="submit" value="Enregistrer"></td>
                        </tr>
                    </table>
                </form>
                <br>
                <br>




			  <!-- End First List -->

			</div>
		  </div>

		</div>
        <?php include("_Layout/layout_footer.php") ?>
	</body>
</html>
