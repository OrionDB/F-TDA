<!DOCTYPE html>
<html>
	<!--
    Author      :   Daniel Baltensperger
    Date        :   31.05.2016
    Description :   forum page for the Ares Team Forum
    -->

    <?php
    session_start();

    $URL = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

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

        $posts = $work->getAllPostsBySubjectId($_GET['id']);



        ?>


        <!-- Div where all the forums are printed -->
		<div class="wrapper">
		  <div class="content-wrapper">
			<div class="content">



                <?php $name = $_GET['name'];

                $actualAccreditation = $work->getForAccreditationById($_GET['id']);

                // Define a store variable
                $printF = false;
                // Check if the current Accreditation is in the function Accreditation
                foreach($_SESSION['Accreditation'] as $acc){

                if($printF == false){
                if($acc['funAccreditation'] == $actualAccreditation[0]['forAccreditation']){
                $printF = true;
                }
                }
                }

                // Check if the current accreditation is in the rank Accreditation
                foreach($_SESSION['rankAccreditation'] as $acc){
                if($printF == false){
                if($acc == $actualAccreditation[0]['forAccreditation']){
                $printF = true;
                }
                }
                }

                // Check if the user is allowed to see want they are in this forum
                if($printF == false){
                echo "<blockquote>Vous n'avez pas accès à ce contenu, veuillez contacter un officier supérieur si il s'agit d'une erreur.</blockquote>";
                }elseif($printF == true){


                ?>

                    <h4><?php echo $_GET['name'] ?></h4>
			  
				  <dl>
                      <table>


                          <!-- Start Php Completion Post -->
                          <?php
                            // Foreach post, print the post
                            foreach($posts as $post){
                                $color = $post['graColor'];

                                $posText = str_replace("\n","<br/>",$post['posText']);

                                echo "
                                    <tr>
                                        <td colspan=\"2\" class=\"tStartPost\"></td>
                                    </tr>
                                    <tr>
                                        <td class=\"tMeta\"><img class=\"tPImg\" src=\"../../userContent/profilePicture/$post[memPseudo].jpg\" width=\"150\" alt=\"Test\"></td>
                                        <td class=\"tPost\" rowspan=\"4\">$posText</td>
                                    </tr>
                                    <tr>
                                        <td class=\"tMeta\" style=\"color: $color;\">$post[memPseudo]</td>
                                    </tr>
                                    <tr>
                                        <td class=\"tMeta\">$post[graName]</td>
                                    </tr>
                                    <tr>
                                        <td class=\"tMeta\">$post[funName]</td>
                                    </tr>";
                                for($i = 0; $i<count($_SESSION['Accreditation']);$i++){

                                    if($_SESSION['Accreditation'][$i]['funAccreditation'] == 33){

                                        echo "<tr>
                                            <td colspan=\"2\" class=\"tEndPost\"><a href='editPost.php?id=$post[idPost]&url=$URL&name=$name'>Editer</a>&nbsp;&nbsp;&nbsp;<a href='deletePost.php?id=$post[idPost]&url=$URL&name=$name'>Supprimer</a></td>
                                            </tr>";
                                        break;
                                    }else{
                                        echo "<tr>
                                                <td colspan=\"2\" class=\"tEndPost\"></td>
                                            </tr>";
                                        break;
                                    }

                                }
                            }

                          ?>
                      </table>


                      <?php
                      if(isset($_SESSION['namPseudo'])){
                      ?>
                      <table class="tNPostT">
                          <tr>
                              <th colspan="2" class="tNtd2"></th>
                          </tr>
                          <form name="fNewPost" method="post" action="processNewPost.php">

                                  <tr>
                                      <th colspan="2" class="tNtd"><h6>Nouveau Post :</h6></th>
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
                                      <td colspan="2" class="tNtd"><input type="submit"></td>
                                  </tr>

                              <?php echo"<input name=\"topicId\" type='hidden' value='$_GET[id]'>"; ?>
                              <?php echo"<input name=\"name\" type='hidden' value='$_GET[name]'>"; ?>
                              <?php echo"<input name=\"URL\" type='hidden' value='$URL'>"; ?>


                          </form>


                      </table>
                      <?php
                      }
                      ?>
				  </dl>

                <?php
                }
                ?>
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