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
	<body class="bForum">
		<?php include("_Layout/layout_header.php") ?>
		
		<!-- Start Navigation bar -->
        <?php include("_Layout/layout_menu.php") ?>
		<!-- End Navigation bar -->

        <?php
        include("Class/DbAccess.php");
        $work = new DbAccess();

        $forums = $work->getAllForumsFirstLevel();

        //var_dump($forums);
        //print_r($forums);
        //echo count($forums);

        ?>


        <!-- Div where all the forums are printed -->
		<div class="wrapper">
		  <div class="content-wrapper">
			<div class="content">
			  <h4>Forums</h4>
			  
			  <!-- Start First List 1 columns -->
			  
				  <dl>
                      <table>


                          <?php



                            //print_r($nbrSubjectsInTheForum);

                            // Print All the forum of the selected level
                            foreach($forums as $forum){

                                if($forum['forAccreditation'] <= 9){
                                    //$nbrSubjectsInTheForum = $work->getNbrSubjectsInTheForum($forum['forName']);
                                    //print_r($nbrSubjectsInTheForum);
                                    //$nbrSub = $nbrSubjectsInTheForum[0]['nbrSubjects'];
                                    $nbrSub = 1;

                                    if(ctype_digit($forum['forAddiction']) == 1){
                                        echo("<tr>
                                        <dt>$forum[forName]</dt>
                                        <dd>
                                            <table>
                                                <tr>
                                                    <td class=\"forDescription\"><em>$forum[forDescription]</em></td>
                                                    <td class=\"forNbrSubjectsInForum\">$nbrSub</td>
                                                    <td class=\"forLastMessage\">OrionDB,<br> 31.05.2016</td>
                                                </tr>
                                            </table>
                                        </dd>");
                                    }elseif(preg_match("/^[0-9][.][0-9]$/",$forum['forAddiction'])){
                                        echo("<tr>
                                        <dt class=\"forNamel2\">$forum[forName]</dt>
                                        <dd>
                                            <table>
                                                <tr>
                                                    <td class=\"forDescriptionl2\"><em>$forum[forDescription]</em></td>
                                                    <td class=\"forNbrSubjectsInForum\">$nbrSub</td>
                                                    <td class=\"forLastMessage\">OrionDB,<br> 31.05.2016</td>
                                                </tr>
                                            </table>
                                        </dd>");
                                    }
                                }




                            }
                          ?>


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
