<!DOCTYPE html>
<html>
	<!--
    Author      :   Daniel Baltensperger
    Date        :   31.05.2016
    Description :   Members List for the Ares Team Forum
    -->

    <?php
        session_start();

        include("Class/DbAccess.php");
        $work = new DbAccess();
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
	<body class="bmembers">
    <?php include("_Layout/layout_header.php") ?>

    <!-- Start Navigation bar -->
    <?php include("_Layout/layout_menu.php") ?>
    <!-- End Navigation bar -->
		
		
		<div class="wrapper">
		  <div class="content-wrapper">
			<div class="content">


                <?php
                if(isset($_SESSION['namPseudo'])){

                    // Find the information about the member
                    $member = $work->getMemberByName($_GET['id']);

                    //print_r($member);

                    $color = $member[0]['graColor'];
                    $pseudo = $member[0]['memPseudo'];

                ?>
			  <!-- Start First List 1 columns -->
                    <h4><?php echo $_GET['id']?></h4>

				  <dl>
					<table class="pTable">
                        <tr>
                            <td rowspan="5" class="pPicture"><img src='../../userContent/profilePicture/<?php echo $pseudo ?>.jpg' alt="Image non définie" width="150px"></td>
                            <th class="pOther">Pseudo</th>
                            <td class="pOther" ><?php echo ("<span style=\"color: $color;\">".$member[0]["memPseudo"]."</span>") ?></td>
                        </tr>
                        <tr>

                            <th class="pOther">Grade</th>
                            <td class="pOther"><?php echo $member[0]['graName'] ?></td>
                        </tr>
                        <tr>

                            <th class="pOther">Fonction</th>
                            <td class="pOther"><?php echo $member[0]['funName'] ?></td>
                        </tr>
                        <tr>

                            <th class="pOther">Date d'inscription</th>
                            <td class="pOther"><?php echo $member[0]['memEnterDate'] ?></td>
                        </tr>
                        <tr>

                            <th class="pOther">Nbr de message</th>
                            <td class="pOther"><?php echo $member[1][0]['nbrPost'] ?></td>
                        </tr>
                        <tr>
                            <td><h5>Divers</h5></td>
                        </tr>
                        <tr>
                            <td colspan="3"><?php echo $member[0]['memVarious']?></td>
                        </tr>

					</table>
				  </dl>

                <?php

                }else{
                    echo "<blockquote><p>Vous n'avez pas le droit d'afficher cette page, veuillez vous connecter</p></blockquote>";
                }
                ?>


			  <!-- End First List -->
			  
			</div>
		  </div>
		  
		</div>
		<div class="footer">
		  <p>Copyright &copy; 2015-2016 Team d'Ares. All rights reserved. </p>
		  <p> Initial Design by <a href="http://www.nikhedonia.com/" title="SimplyGold">Sadhana Ganapathiraju</a>, Editing Design by <a href="">Daniel Baltensperger</a>. </p>
		  <p> <a href="#">Terms of Service</a> | <a href="#">Privacy</a> | <a href="#">Contact</a> | <a href="#">About</a> | <a href="http://validator.w3.org/check/referer" title="Valid XHTML 1.0 Strict">Xhtml</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer?warning=no&amp;profile=css2" title="Valid CSS 2.0 Strict">Css</a> </p>
		</div>
	</body>
</html>
