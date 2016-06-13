<!DOCTYPE html>
<html>
	<!--
    Author      :   Daniel Baltensperger
    Date        :   31.05.2016
    Description :   Home page for the Ares Team Forum
    -->

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
	<body class="bhome">
    <?php include("_Layout/layout_header.php") ?>

    <!-- Start Navigation bar -->
    <?php include("_Layout/layout_menu.php") ?>
    <!-- End Navigation bar -->
		
		
		<div class="wrapper">
		  <div class="content-wrapper">
			<div class="content">
			  <h4>Forums</h4>
			  
			  <!-- Start First List 1 columns -->
			  
				  <dl>
					<dt>Bienvenue sur le Forum de la Team d'Ares</dt>
					<dd class="newsHome">Je suis Orion, chef et fondateur de la team, je suis également officier supérieur à la CDF.<br><br>
						Cette team est ouverte à tous joueur désirant partager sa passion des jeux vidéo, quelqu'il soit.<br>
						Votre jeux n'est pas encore représenté, dans ce cas, contacter moi, je me ferais un plaisir de discuter avec vous des modalité d'ajout d'un jeux 
						dans notre base de données.</dd>
					<dt>Avis de Recrutement</dt>
					<dd class="newsHome">Bonjours, suite à la sortie de notre nouveau forum, nous relançons les campagnes de recrutement, par conséquent, si vous vous sentez l'âme de contribuer activement à la vie de la team, n'hésiter pas à passer faire un tour dans la section "Recrutement" du forum "Candidature" pour
						 voir les différents poste à pourvoir.<br><br>
						 Cordialement le Commandement
						
				  </dl>

                <?php
                    echo date("d.m.Y-H:i");

                    echo "<br><br>".$_SESSION['namPseudo'];
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
