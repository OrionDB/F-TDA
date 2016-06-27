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
			  <h4>Membres</h4>

                <?php
                if(isset($_SESSION['namPseudo'])){


                ?>
			  <!-- Start First List 1 columns -->
			  
				  <dl>
					<table>
                        <tr>
                            <th>Pseudo</th>
                            <th>Membre depuis</th>
                            <th>Grade</th>
                            <th>Fonction</th>
                            <th>Action</th>
                        </tr>
                        <?php

                            // Find all members
                            $members = $work->getMemberslist();

                            foreach($members as $member){
                                $color = $member['graColor'];

                                //$member['memPseudo'] = addslashes($member['memPseudo']);

                                echo("
                                    <tr>
                                        <td class=\"mPseudo\" ><a href=\"profile.php?id=$member[memPseudo]\" style=\"color: $color;\">$member[memPseudo]</a></td>

                                        <td class=\"mDate\">$member[memEnterDate]</td>
                                        <td class=\"mRank\">$member[graName]</td>
                                        <td class=\"mFunction\">$member[funName]</td>
                                        <td class=\"MAction\">P - D - E - F</td>
                                    </tr>
                                ");
                            }

                        ?>
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
