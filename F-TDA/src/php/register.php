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
<body class="bRegister">
        <?php include("_Layout/layout_header.php") ?>

            <!-- Start Navigation bar -->
        <?php include("_Layout/layout_menu.php") ?>
            <!-- End Navigation bar -->

        <?php
            include("Class/DbAccess.php");
            $work = new DbAccess();
        ?>


		<div class="wrapper">
		  <div class="content-wrapper">
			<div class="content">
			  <h4>Inscription</h4>

			  <!-- Start First List 1 columns -->

                <form class="registerForm" method="post" action="#">
                    <table>
                        <tr>
                            <th>Pseudo</th>
                            <td><input name ="iPseudo" type="text"></td>
                        </tr>
                        <tr>
                            <th>Mot de passe</th>
                            <td><input name="iPassword" type="password"></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td><input type="submit"></td>
                        </tr>
                    </table>
                    <br>
                    <br>
                </form>


			  <!-- End First List -->

			</div>
		  </div>

		</div>
        <?php include("_Layout/layout_footer.php") ?>
	</body>
</html>
