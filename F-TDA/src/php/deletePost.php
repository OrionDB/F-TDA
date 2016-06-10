<!DOCTYPE html>
<html>
	<!--
    Author      :   Daniel Baltensperger
    Date        :   31.05.2016
    Description :   forum page for the Ares Team Forum
    -->

    <?php
    session_start();

    // Set the $_session['Accreditation'] variable to 0 if the variable is not set
    if(!isset($_SESSION['Accreditation'][0]['funAccreditation'])){
        $_SESSION['Accreditation'][0]['funAccreditation'] = 0;
    }

    // Ignore error by non-indexing array
    //error_reporting(E_ERROR | E_WARNING | E_PARSE);
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
	<body class="bForum">
		<?php include("_Layout/layout_header.php") ?>
		
		<!-- Start Navigation bar -->
        <?php include("_Layout/layout_menu.php") ?>
		<!-- End Navigation bar -->

        <?php

        // Include the class and create the work variable
        include("Class/DbAccess.php");
        $work = new DbAccess();

        $work->deletePostById($_GET['id']);

        $URL = $_GET['url'];

        header("location: $URL&name=$_GET[name]")

        ?>


        <!-- Div where all the forums are printed -->
		<div class="wrapper">
		  <div class="content-wrapper">
			<div class="content">



			  <!-- Start First List 1 columns -->



			  <!-- End First List -->
			</div>
		  </div>
		  
		</div>
        <!-- End printed the forums -->

        <!-- Footer -->
        <?php //include("_Layout/layout_footer.php") ?>
        <div class="footer">
            <p>Copyright &copy; 2015-2016 Team d'Ares. All rights reserved. </p>
            <p> Initial Design by <a href="http://www.nikhedonia.com/" title="SimplyGold">Sadhana Ganapathiraju</a>, Editing Design by <a href="">Daniel Baltensperger</a>. </p>
            <p> <a href="#">Terms of Service</a> | <a href="#">Privacy</a> | <a href="#">Contact</a> | <a href="#">About</a> | <a href="http://validator.w3.org/check/referer" title="Valid XHTML 1.0 Strict">Xhtml</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer?warning=no&amp;profile=css2" title="Valid CSS 2.0 Strict">Css</a> </p>
        </div>
	</body>
</html>