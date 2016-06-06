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
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
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

        // get all forums andstore it into a variable
        $forums = $work->getAllForumsFirstLevel();

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

                            // Search the Root addiction of the actual forum
                            foreach($forums as $sad){

                                if($sad['forName'] == $_GET['id']){
                                    $alpha = $sad['forAddiction'];
                                }
                            }

                            // Print All the forum of the selected level
                            foreach($forums as $forum){

                                // Check the number of forums we must print
                                for($i = 0;$i<count($_SESSION['Accreditation']) + count($_SESSION['rankAccreditation']);$i++){

                                    // Around by the floor the Addiction of the current forum
                                    if(floor($forum['forAddiction']) == $alpha){

                                        // Check if we have the accreditation for print this forum
                                        if($forum['forAccreditation'] == $_SESSION['Accreditation'][$i]['funAccreditation'] || $forum['forAccreditation'] == $_SESSION['rankAccreditation'][$i]){
                                            //$nbrSubjectsInTheForum = $work->getNbrSubjectsInTheForum($forum['forName']);
                                            //print_r($nbrSubjectsInTheForum);
                                            //$nbrSub = $nbrSubjectsInTheForum[0]['nbrSubjects'];
                                            $nbrSub = 1;

                                            // Check if the forum is in the first level or the second one
                                            if(preg_match("/^[0-9][.][0-9]$/",$forum['forAddiction'])){
                                                echo("<tr>
                                                <dt><a href=\"forum.php?id=$forum[forName]\">$forum[forName]</a></dt>
                                                <dd>
                                                    <table>
                                                        <tr>
                                                            <td class=\"forDescription\"><em>$forum[forDescription]</em></td>
                                                            <td class=\"forNbrSubjectsInForum\">$nbrSub</td>
                                                            <td class=\"forLastMessage\">OrionDB,<br> 31.05.2016</td>
                                                        </tr>
                                                    </table>
                                                </dd>");
                                            }elseif(preg_match("/^[0-9][.][0-9]{2}$/",$forum['forAddiction'])){
                                                echo("<tr>
                                                <dt class=\"forNamel2\"><a href=\"forum.php?id=$forum[forName]\">$forum[forName]</a></dt>
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
                                    }elseif(strncmp($forum['forAddiction'],$alpha,3) == 0 && preg_match("/^[0-9][.][0-9]{2}$/",$forum['forAddiction']) && $_GET['id'] != $forum['forName']){
                                        if($forum['forAccreditation'] == $_SESSION['Accreditation'][$i]['funAccreditation'] || $forum['forAccreditation'] == $_SESSION['rankAccreditation'][$i]){
                                            //$nbrSubjectsInTheForum = $work->getNbrSubjectsInTheForum($forum['forName']);
                                            //print_r($nbrSubjectsInTheForum);
                                            //$nbrSub = $nbrSubjectsInTheForum[0]['nbrSubjects'];
                                            $nbrSub = 1;

                                            echo("<tr>
                                                    <dt class=\"forName\"><a href=\"forum.php?id=$forum[forName]\">$forum[forName]</a></dt>
                                                    <dd>
                                                        <table>
                                                            <tr>
                                                                <td class=\"forDescription\"><em>$forum[forDescription]</em></td>
                                                                <td class=\"forNbrSubjectsInForum\">$nbrSub</td>
                                                                <td class=\"forLastMessage\">OrionDB,<br> 31.05.2016</td>
                                                            </tr>
                                                        </table>
                                                    </dd>");
                                        }
                                    }
                                }



                            }
                          ?>

                        </table>
				  </dl>

                <h4>Sujets</h4>

                <blockquote>
                    <table>
                        <?php
                        ///if($forum['forAccreditation'] == $_SESSION['Accreditation'][$i]['funAccreditation'] || $forum['forAccreditation'] == $_SESSION['rankAccreditation'][$i]){
                            $subjects = $work->getSubjectsByForumName($_GET['id']);
                            //print_r($subjects[0]);
                            //echo $subjects[0]['subTitle'];

                            foreach($subjects as $subject){
                                echo("
                                <tr>
                                    <th class=\"subTitle\">$subject[subTitle]</th>
                                    <td class=\"subAuthor\">$subject[memPseudo]</td>
                                    <td class=\"subAnswer\">6</td>
                                    <td class=\"subLast\">Iota</td>
                                </tr>
                                ");
                            }


                        //}
                        ?>
                    </table>
                </blockquote>
			  <!-- End First List -->
			</div>
		  </div>
		  
		</div>
        <!-- End printed the forums -->

        <!-- Footer -->
        <?php include("_Layout/layout_footer.php") ?>
	</body>
</html>
