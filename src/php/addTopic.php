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
<body class="bRegister">
        <?php include("_Layout/layout_header.php") ?>

            <!-- Start Navigation bar -->
        <?php include("_Layout/layout_menu.php") ?>
            <!-- End Navigation bar -->

        <?php
            include("Class/DbAccess.php");
            $work = new DbAccess();

            if(isset($_SESSION['namPseudo'])){
        ?>


		<div class="wrapper">
		  <div class="content-wrapper">
			<div class="content">
			  <h4>Nouveau Topic</h4>

			  <!-- Start First List 1 columns -->

                <form class="registerForm" method="post" action="processAddTopic.php">
                    <table>
                        <tr>
                            <th class="tMeta2">Titre</th>
                            <td><input name ="Title" type="text"></td>
                        </tr>
                        <tr>
                            <th class="tMeta2"><b><u>Balise Formatage</u></b></th>
                            <td rowspan="7" class="tNPostTxt"><textarea class="tNPost" name="Post"></textarea></td>
                        </tr>
                        <tr>
                            <td class="tMeta2">Italique : [i][/i]</td>
                        </tr>
                        <tr>
                            <td class="tMeta2">Couleur : [color = "couleur"][/color]</td>
                        </tr>
                        <tr>
                            <td class="tMeta2">Gras : [b][/b]</td>
                        </tr>
                        <tr>
                            <td class="tMeta2">Gras : [b][/b]</td>
                        </tr>
                        <tr>
                            <td class="tMeta2">Gras : [b][/b]</td>
                        </tr>
                        <tr>
                            <td class="tMeta2">Souligné : [u][/u]</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="tNtd"><input type="submit" value="Créer"></td>
                        </tr>
                        <?php
                        echo "<input type=\"hidden\" name='forum' value=\"$_GET[name]\">";
                        ?>
                    </table>
                    <br>
                    <br>
                </form>


			  <!-- End First List -->

			</div>
		  </div>

		</div>
        <?php
            }else{
                echo "<blockquote>Vous n'avez pas accès à ce contenu, veuillez contacter un officier supérieur si il s'agit d'une erreur.</blockquote>";
            }


        include("_Layout/layout_footer.php") ?>
	</body>
</html>
