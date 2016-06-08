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

        //print_r($_GET);

        $posts = $work->getAllPostsBySubjectId($_GET['id']);

        //echo"<br><br><br>";
        //print_r($posts);

        // get all forums and store it into a variable
        //$forums = $work->getAllForumsFirstLevel();

        ?>


        <!-- Div where all the forums are printed -->
		<div class="wrapper">
		  <div class="content-wrapper">
			<div class="content">
			  <h4><?php echo $_GET['name'] ?></h4>
			  
			  <!-- Start First List 1 columns -->
			  
				  <dl>
                      <table>


                          <!-- Start Php Completion Post -->
                          <?php
                            // Foreach post, print the post
                            foreach($posts as $post){
                                $color = $post['graColor'];

                                echo "
                                    <tr>
                                        <td colspan=\"2\" class=\"tStartPost\"></td>
                                    </tr>
                                    <tr>
                                        <td class=\"tMeta\"><img class=\"tPImg\" src=\"../../userContent/profilePicture/$post[memPseudo].jpg\" width=\"150\" alt=\"Test\"></td>
                                        <td class=\"tPost\" rowspan=\"4\">$post[posText]</td>
                                    </tr>
                                    <tr>
                                        <td class=\"tMeta\" style=\"color: $color;\">$post[memPseudo]</td>
                                    </tr>
                                    <tr>
                                        <td class=\"tMeta\">$post[graName]</td>
                                    </tr>
                                    <tr>
                                        <td class=\"tMeta\">$post[funName]</td>
                                    </tr>
                                    <tr>
                                        <td colspan=\"2\" class=\"tEndPost\"></td>
                                    </tr>
                                ";
                            }

                          ?>

                          <tr>
                              <th colspan=\"2\" class="tNtd">Nouveau Post :</th>
                          </tr>
                          <form name="fNewPost" method="post" action="#">
                              <tr>

                                <th>Balise Formatage</th>
                                <td rowspan="4"><textarea class="tNPost" name="Post"></textarea></td>
                              </tr>
                              <tr>
                                  <td><i>Italique : [i][/i]</i></td>
                              </tr>
                              <tr>
                                  <td><b>Gras : [b][/b]</b></td>
                              </tr>
                              <tr>
                                  <td><u>Souligné : [u][/u]</u></td>
                              </tr>
                              <tr>
                                  <td colspan="2" class="tNtd"><input type="submit"></td>
                              </tr>
                          </form>

                        </table>
				  </dl>
			  <!-- End First List -->
			</div>
		  </div>
		  
		</div>
        <!-- End printed the forums -->

        <!-- Footer -->
        <?php include("_Layout/layout_footer.php") ?>
	</body>
</html>
