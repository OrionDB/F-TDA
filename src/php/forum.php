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

                <?php

                // Find the current level of Accreditation
                foreach($forums as $forum){
                    if($forum['forName'] == $_GET['id']){
                        $actualAccreditation = $forum['forAccreditation'];
                    }
                }

                // Define a store variable
                $printF = false;
                // Check if the current Accreditation is in the function Accreditation
                foreach($_SESSION['Accreditation'] as $acc){

                    if($printF == false){
                        if($acc['funAccreditation'] == $actualAccreditation){
                            $printF = true;
                        }
                    }
                }

                // Check if the current accreditation is in the rank Accreditation
                foreach($_SESSION['rankAccreditation'] as $acc){
                    if($printF == false){
                        if($acc == $actualAccreditation){
                            $printF = true;
                        }
                    }
                }

                // Check if the user is allowed to see want they are in this forum
                if($printF == false){
                    echo "<blockquote>Vous n'avez pas accès à ce contenu, veuillez contacter un officier supérieur si il s'agit d'une erreur.</blockquote>";
                }elseif($printF == true){


                ?>

				  <dl>




                      <table>


                          <?php

                          $allNbrSubject = $work->getNbrSubjectsInAllForums();

                            // Search the Root addiction of the actual forum
                            foreach($forums as $sad){

                                if($sad['forName'] == $_GET['id']){
                                    $alpha = $sad['forAddiction'];
                                }
                            }

                            // Print All the forum of the selected level
                            foreach($forums as $forum){

                                foreach($allNbrSubject as $forNbrSub){
                                    if($forNbrSub['forName'] == $forum['forName']){
                                        $nbrSub = $forNbrSub['NbrSubject'];
                                    }
                                }

                                // Check the number of forums we must print
                                for($i = 0;$i<count($_SESSION['Accreditation']) + count($_SESSION['rankAccreditation']);$i++){

                                    // Around by the floor the Addiction of the current forum
                                    if(floor($forum['forAddiction']) == $alpha){

                                        // Check if we have the accreditation for print this forum
                                        if($forum['forAccreditation'] == $_SESSION['Accreditation'][$i]['funAccreditation'] || $forum['forAccreditation'] == $_SESSION['rankAccreditation'][$i]){
                                            //$nbrSub = 1;
											
											$LastPostInForum = $work->getLastPostInForum($forum['forName']);
											
											//print_r($LastPostInForum);

                                            // Check if the forum is in the first level or the second one
                                            if(preg_match("/^[0-9][.][0-9]$/",$forum['forAddiction'])){
                                                echo("<tr>
                                                <dt><a href=\"forum.php?id=$forum[forName]\">$forum[forName]</a></dt>
                                                <dd>
                                                    <table>
                                                        <tr>
                                                            <td class=\"forDescription\"><em>$forum[forDescription]</em></td>
                                                            <td class=\"forNbrSubjectsInForum\">$nbrSub</td>
                                                            <td class=\"forLastMessage\">OrionDB,<br> 31.05.2016-18:30</td>
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
                                                            <td class=\"forLastMessage\">OrionDB,<br> 31.05.2016-18:30</td>
                                                        </tr>
                                                    </table>
                                                </dd>");
                                            }
                                        }
                                    }elseif(strncmp($forum['forAddiction'],$alpha,3) == 0 && preg_match("/^[0-9][.][0-9]{2}$/",$forum['forAddiction']) && $_GET['id'] != $forum['forName']){
                                        if($forum['forAccreditation'] == $_SESSION['Accreditation'][$i]['funAccreditation'] || $forum['forAccreditation'] == $_SESSION['rankAccreditation'][$i]){
                                            //$nbrSub = 1;

                                            echo("<tr>
                                                    <dt class=\"forName\"><a href=\"forum.php?id=$forum[forName]\">$forum[forName]</a></dt>
                                                    <dd>
                                                        <table>
                                                            <tr>
                                                                <td class=\"forDescription\"><em>$forum[forDescription]</em></td>
                                                                <td class=\"forNbrSubjectsInForum\">$nbrSub</td>
                                                                <td class=\"forLastMessage\">OrionDB,<br> 31.05.2016-18:30</td>
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

                                $nbrAllAnswer = $work->getAllNbrAnswerByForumName($_GET['id']);

                                foreach($subjects as $subject){

                                    foreach($nbrAllAnswer as $nbrAnswer){
                                        if($nbrAnswer['subTitle'] == $subject['subTitle']){
                                            $nbr = $nbrAnswer['nbrAnswer']-1;
                                        }
                                    }

                                    $lastPost = $work->getLastPostInSubject($subject['subTitle']);
									$colorAuth = $subject['graColor'];
                                    $lastPseudo = $lastPost[0]['memPseudo'];
                                    $lastHour = $lastPost[0]['posDate'];
									$color = $lastPost[0]['graColor'];
									
                                    echo("
                                    <tr>
                                        <th class=\"subTitle\"><a href=\"topic.php?id=$subject[idSubject]&name=$subject[subTitle]\">$subject[subTitle]</a></th>
                                        <td class=\"subAuthor\"><span style=\"color: $colorAuth;\">$subject[memPseudo]</span></td>
                                        <td class=\"subAnswer\">$nbr</td>
                                        <td class=\"subLast\" ><span style=\"color: $color;\">$lastPseudo</span> le<br> $lastHour</td>
                                    </tr>
                                    ");
                                }


                            //}
                            ?>

                            <tr>
                                <th class="subTitle" style="text-align: center; font-size: 15px;"><a href="addTopic.php?name=<?php echo $_GET['id']?>">Nouveau Sujet</a></th>
                            </tr>
                        </table>
                    </blockquote>

                <?php
                }else{
                    echo "<blockquote>Vous n'avez pas accès à ce contenu, veuillez contacter un officier supérieur si il s'agit d'une erreur.</blockquote>";
                }
                ?>
			  <!-- End First List -->
			</div>
		  </div>
		  
		</div>
        <!-- End printed the forums -->

        <!-- Footer -->
        <?php include("_Layout/layout_footer.php") ?>
	</body>
</html>
