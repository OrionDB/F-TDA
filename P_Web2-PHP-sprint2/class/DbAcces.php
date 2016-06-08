<?php
/*
Author : Yvan Cochet
Summary : Class to access the db
Date : 01.03.2016
*/

//FUNCTION HEADER
/// <summary>
/// :summary:
/// </summary>
/// <param name=":paramName:">:description</param>

class DbAcces
{
    //Var with connection to database
    private $db;

    //Category to print
    private $category;

    //FUNCTION HEADER
    /// <summary>
    /// Setter for the category
    /// </summary>
    /// <param name="cat">name of the category</param>
    public function setCategory($cat)
    {
        $this->category = $cat;
    }

    //FUNCTION HEADER
    /// <summary>
    /// Function to connect the database
    /// </summary>
    public function connectDB()
    {
        //Var to acces db
        $login = 'root';
        $password = '';
        $host = 'localhost';
        $dbName = 'db_cif2';

        //Connection to the DB with UTF8
        $this->db = new PDO(sprintf('mysql:host=%s;dbname=%s', $host, $dbName), $login, $password, array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }

    //FUNCTION HEADER
    /// <summary>
    /// Function to print one CIF
    /// </summary>
    /// <param name="id">id of the cif</param>
    /// <param name="title">title of the cif</param>
    /// <param name="description">description of the cif/param>
    /// <param name="path">Path to page folder</param>
    private function printOneCIF($id,$title, $description, $path, $URL)
    {
        ?>
        <!--Div for CIF and title + text inside-->
        <?php echo ('<a class="cif-detail-link" href="'.$path.'cifDetail.php?id='.$id.'">');?>
            <div class="cif">
                <h4 class="cif-title">
                    <?php
                    echo $title;
                    ?>
                </h4>
                <p class="cif-description">
                    <?php
                    //Write only the first 380 character of the cif
                    echo substr($description, 0, 380).'...';
                    ?>
                </p>
                <?php
                if(isset($_SESSION['namPseudo'])) {
                    ?>
                    <!--Dropdown evaluate-->
                    <div class="cif-bottom">
                        <ul class="ul-dropdown">
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="evaluate-link" role="link">Evaluer <span
                                        class="glyphicon glyphicon-star-empty"></span></a>

                                <div class="dropdown-menu">
                                    <form class="form" method="post" action="<?php echo $path.'addComment.php'; ?>" accept-charset="UTF-8">
                                        <div class="form-group">
                                            <textarea class="form-control" name="comment" rows="4" placeholder="Commentaire"></textarea>
                                        </div>
                                        <div class="form-group" id="div-evaluate">
                                            <input type="radio" name="evaluation" value="1" checked>&nbsp;<span
                                                class="glyphicon glyphicon-star"></span><br/>
                                            <input type="radio" name="evaluation" value="2">&nbsp;<span
                                                class="glyphicon glyphicon-star"></span><span
                                                class="glyphicon glyphicon-star"></span><br/>
                                            <input type="radio" name="evaluation" value="3">&nbsp;<span
                                                class="glyphicon glyphicon-star"></span><span
                                                class="glyphicon glyphicon-star"></span><span
                                                class="glyphicon glyphicon-star"></span><br/>
                                            <input type="radio" name="evaluation" value="4">&nbsp;<span
                                                class="glyphicon glyphicon-star"></span><span
                                                class="glyphicon glyphicon-star"></span><span
                                                class="glyphicon glyphicon-star"></span><span
                                                class="glyphicon glyphicon-star"></span><br/>
                                            <input type="radio" name="evaluation" value="5">&nbsp;<span
                                                class="glyphicon glyphicon-star"></span><span
                                                class="glyphicon glyphicon-star"></span><span
                                                class="glyphicon glyphicon-star"></span><span
                                                class="glyphicon glyphicon-star"></span><span
                                                class="glyphicon glyphicon-star"></span><br/>

                                            <input name="idCif" type="hidden" value="<?php echo $id; ?>">
                                            <input name="URL" type="hidden" value="<?php echo $URL; ?>">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Soumettre</button>
                                        </div>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--Dropdown evaluate-->
                <?php
                }
                ?>
            </div>
        </a>
        <?php

    }//END printOneCIF

    //FUNCTION HEADER
    /// <summary>
    /// Function to print the last 5 CIFS
    /// </summary>
    ///<param name="URL">URL of the page where we call the method, used to redirecte after sending a comment</param>
    public function printLastMiniCif($URL)
    {
        //Req to get all the cifs
        $reqCif = $this->db->query('SELECT cifTitle,cifDescription,idCIF FROM t_cif ORDER BY idCif DESC LIMIT 5');

        //Write all the cifs
        while($cif = $reqCif->fetch())
        {
            $this->printOneCIF($cif['idCIF'],$cif['cifTitle'],$cif['cifDescription'],'./page/', $URL);

        }//END while

        $reqCif->closeCursor();

    }//END printLastMiniCif

    //FUNCTION HEADER
    /// <summary>
    /// Function to print one CIF from its id with its comment
    /// </summary>
    /// <param name="id">id of the cif to show</param>
    ///<param name="URL">URL of the page where we call the method, used to redirecte after sending a comment</param>
    public function printCifById($id, $URL)
    {
        /*
         * --------------------------------------------------------------
         * Fonction à améliorer, créer une method pour afficher
         * les étoiles. Possible de réduire le code. SI LE TEMPS LE PERMET
         * ---------------------------------------------------------------
         * */

        //Req to get info about the CIF
        $reqCif = $this->db->prepare('SELECT * FROM t_cif INNER JOIN t_category ON t_cif.fkCategory = t_category.idCategory INNER JOIN t_member ON t_cif.fkMember = t_member.idMember WHERE idCIF = :idCIF');
        $reqCif->execute(array(
            'idCIF' => $id
        ));
        $cif = $reqCif->fetch();

        //Req to get the evaluation of the cif
        $reqEval = $this->db->prepare('SELECT COUNT(idEvaluation) AS "nbEval",ROUND(AVG(evaNote),1) AS "eval" FROM t_evaluation WHERE fkCIF = :fkCIF');
        $reqEval->execute(array(
            'fkCIF' => $id
        ));
        $eval = $reqEval->fetch();


        ?>
        <!--_____________________CIF_________________-->
        <div class="cif-category-container">
            <h3 class="cif-category-title"><?php echo $cif['catName'];?></h3>
            <div class="cif-detail">
                <h4 class="cif-title"><?php echo $cif['cifTitle'];?></h4>
                <p>
                    <?php
                    //Add <br/> to the string
                    $cif['cifDescription'] = str_replace("\n","<br/>",$cif['cifDescription']);
                    echo $cif['cifDescription'];
                    ?>
                </p>
                <div class="cif-detail-bottom">
                    <p>Posté par <?php echo $cif['memPseudo']; ?> | Nombre d'évaluations : <?php echo $eval['nbEval']?> | Note :
                        <?php
                        //Round the average to 0.5
                        $eval['eval'] = round($eval['eval'] * 2) / 2;

                        //Loop to write the average of notes of the cif

                        //Check nb of full star to write
                        for($o = $eval['eval']; $o > 0.5; $o--)
                        {
                            echo '<span class="glyphicon glyphicon-star"></span>';
                            //If there's 0.5 left, put a half star
                            if($o-1 == 0.5)
                            {
                                echo '<span class="glyphicon glyphicon-star half"></span>';
                            }//END if

                        }//END for

                        //Write the rest of the empty stars
                        //Ceil = around to supp
                        for($z = 0; $z < 5-ceil($eval['eval']); $z++)
                        {
                            echo '<span class="glyphicon glyphicon-star empty"></span>';
                        }//END for

                        $reqEval->closeCursor();
                        $reqCif->closeCursor();
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <!--_____________________/CIF_________________-->

        <!--_____________________Comment_________________-->
        <div class="cif-category-container">
            <h3 class="cif-category-title">Commentaires</h3>
            <?php
            //Req to get all the comment of the cif
            $reqComment = $this->db->prepare('SELECT evaComment, evaNote, memPseudo FROM t_evaluation INNER JOIN t_member ON fkMember = idMember WHERE fkCIF = :fkCIF ORDER BY idEvaluation');
            $reqComment->execute(array(
                'fkCIF' => $id
            ));
            echo '<div class="cif-detail comment">';

                //Run all the evaluations
                while($comment = $reqComment->fetch())
                {
                    //Write the comment only if evaComment isn't empty
                    if($comment['evaComment'] !== '') {
                        ?>
                        <h4 class="comment-name">
                            <?php
                            //Round the average to 0.5
                            $comment['evaNote'] = round($comment['evaNote'] * 2) / 2;

                            //Write pseudo
                            echo $comment['memPseudo'] . '&nbsp; | &nbsp;';

                            //Check nb of full star to write
                            for ($o = $comment['evaNote']; $o > 0.5; $o--) {
                                echo '<span class="glyphicon glyphicon-star"></span>';
                                //If there's 0.5 left, put a half star
                                if ($o - 1 == 0.5) {
                                    echo '<span class="glyphicon glyphicon-star half"></span>';
                                }//END if

                            }//END for

                            //Write the rest of the empty stars
                            for ($z = 0; $z < 5 - ceil($comment['evaNote']); $z++) {
                                echo '<span class="glyphicon glyphicon-star empty"></span>';

                            }//END For
                            ?>
                        </h4>
                        <!--Write the comment-->
                        <div class="cif-detail-bottom">
                            <?php
                            //Add <br/> to the string
                            $comment['evaComment'] = str_replace("\n","<br/>",$comment['evaComment']);
                            ?>
                            <p class="comment-text"><?php echo $comment['evaComment']; ?></p>
                        </div>
                    <?php

                    } //END IF

                }//END While
                if(isset($_SESSION['namPseudo']) AND $_SESSION['namPseudo'] !== '') {
                    ?>
                    <h4 class="comment-name"> Ajouter un commentaire :</h4>
                    <div class="cif-detail-bottom">
                        <div class="comment-cif-detail">
                            <form class="form" role="form" method="post" action="addComment.php" accept-charset="UTF-8">
                                <textarea class="form-control" name="comment" rows="10"
                                          placeholder="Commentaire"></textarea><br/>
                                <input type="radio" name="evaluation" value="1" checked>&nbsp;<span
                                    class="glyphicon glyphicon-star"></span><br/>
                                <input type="radio" name="evaluation" value="2">&nbsp;<span
                                    class="glyphicon glyphicon-star"></span><span
                                    class="glyphicon glyphicon-star"></span><br/>
                                <input type="radio" name="evaluation" value="3">&nbsp;<span
                                    class="glyphicon glyphicon-star"></span><span
                                    class="glyphicon glyphicon-star"></span><span
                                    class="glyphicon glyphicon-star"></span><br/>
                                <input type="radio" name="evaluation" value="4">&nbsp;<span
                                    class="glyphicon glyphicon-star"></span><span
                                    class="glyphicon glyphicon-star"></span><span
                                    class="glyphicon glyphicon-star"></span><span
                                    class="glyphicon glyphicon-star"></span><br/>
                                <input type="radio" name="evaluation" value="5">&nbsp;<span
                                    class="glyphicon glyphicon-star"></span><span
                                    class="glyphicon glyphicon-star"></span><span
                                    class="glyphicon glyphicon-star"></span><span
                                    class="glyphicon glyphicon-star"></span><span
                                    class="glyphicon glyphicon-star"></span><br/>
                                <br/>
                                <input name="idCif" type="hidden" value="<?php echo $id; ?>">
                                <input name="URL" type="hidden" value="<?php echo $URL; ?>">
                                <button type="submit" class="btn btn-primary btn-block btn-comment">Soumettre</button>
                            </form>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
            <?php
            $reqComment->closeCursor();
            ?>
        </div>
        <!--_____________________/Comment_________________-->

        <?php
    }//END printCifById

    //FUNCTION HEADER
    /// <summary>
    /// Function to print all the CIF
    /// </summary>
    /// <param name="URL">URL of the page where we executed the method (used to redirect after sending a comment)</param>
    public function printAllCIF($URL)
    {

        //Check if there's filter on category or not
        if($this->category == 'all')
        {
            $reqCIF = $this->db->query('SELECT * FROM t_cif INNER JOIN t_category ON fkCategory = idCategory GROUP BY catName, cifTitle, idCIF');
        }
        else if($this->category !== 'all')
        {
            $reqCIF = $this->db->prepare('SELECT * FROM t_cif INNER JOIN t_category ON fkCategory = idCategory WHERE catName = :catName GROUP BY catName, cifTitle, idCIF');
            $reqCIF->execute(array(
                'catName' => $this->category
            ));

        }//END if

        //Set a category var to null to check when it's a new category
        $cat = "";

        while($cif = $reqCIF->fetch())
        {
            //Print title of the category if it's a new one
            if($cat != $cif['catName'])
            {
                $cat = $cif['catName'];
                echo '</div><div class="cif-category-container">';
                echo '<h3 class="cif-category-title">'.$cat.'</h3>';

                //Method to print a cif
                $this->printOneCIF($cif['idCIF'],$cif['cifTitle'],$cif['cifDescription'],'./',$URL);
            }
            else
            {
                //Method to print a cif
                $this->printOneCIF($cif['idCIF'],$cif['cifTitle'],$cif['cifDescription'],'./',$URL);

            }//END If

        }//END While

    }//END printAllCIF


    //FUNCTION HEADER
    /// <summary>
    /// Function to add a CIF
    /// </summary>
    /// <param name="title">title of the CIF</param>
    /// <param name="description">description of the CIF</param>
    /// <param name="member">Member that posted the CIF</param>
    /// <param name="category">category of the CIF</param>
    public function addCif($title, $description, $member, $category)
    {
        $reqAddCif = $this->db->prepare('INSERT INTO t_cif(idCif, cifTitle, cifDescription, fkMember, fkCategory) VALUES(NULL, :cifTitle, :cifDescription, (SELECT idMember FROM t_member WHERE memPseudo = :memPseudo), (SELECT idCategory FROM t_category WHERE catName = :catName)) ');
        $reqAddCif->execute(array(
            'cifTitle' => $title,
            'cifDescription' => $description,
            'memPseudo' => $member,
            'catName' => $category
        ));
    }



    //FUNCTION HEADER
    /// <summary>
    /// Login Function
    /// </summary>
    public function Login()
    {
        // Store all members in $reqMember
        $reqMember = $this->db->query('SELECT memPseudo,memPassword,memAdmin FROM t_member');

        // testing if the variable is set
        if ($_POST['namPseudo'] != null && $_POST['namPassword'] != null) {


            // Check if the member is registered
            while($member = $reqMember->fetch()){
                if ($member['memPseudo'] == $_POST['namPseudo'] && password_verify($_POST['namPassword'],$member["memPassword"])) {
                    // We start the Session
                    session_start ();

                    // Save the information of our member like session variable
                    $_SESSION['namPseudo'] = $member['memPseudo'];
                    $_SESSION['admin'] = $member['memAdmin'];

                    // disengage the error message
                    $Error = false;

                    //Find the original URL
                    $URL = $_POST['namURL'];

                    // Return to other page
                    header("location: $URL");

                    //header ("location: ../index.php");
                    break;
                }
                else {
                    // Engage the error message
                    $Error = true;
                }
            }

            // If the member is not registered, we print an error message
            if($Error == true){
                // Error message
                echo '<body onLoad="alert(\'Membre non reconnu...\')">';
                // Return to main page
                echo '<meta http-equiv="refresh" content="0;URL=../index.php">';
            }

        }
        else {
            // Error message
            echo '<body onLoad="alert(\'Les variables du formulaire ne sont pas déclarées.\')"> ';
            // Return to main page
            echo '<meta http-equiv="refresh" content="0;URL=../index.php">';
        }
    } //END login

    //FUNCTION HEADER
    /// <summary>
    /// Function for hashing the password enter by the user
    /// </summary>
    /// <param name="pass">Password to hash</param>
    public function hashPassword($pass){

        $hash = (password_hash($pass,PASSWORD_BCRYPT));
        return $hash;
    }


    //FUNCTION HEADER
    /// <summary>
    /// Add a member in the db
    /// </summary>
    public function addMember(){
        // Check if the password entered is the same
        if($_POST['namPasswordm'] == $_POST['namPassword2']){


            $Password = $this->hashPassword($_POST['namPasswordm']);

            $reqAddMember = $this->db->prepare('INSERT INTO t_member (memPseudo, memEnterDate, memPassword) VALUES(:Pseudo, :Date,:Password ) ');
            $reqAddMember->execute(array(
                'Pseudo' => $_POST['namPseudom'],
                'Date' => date("Y-m-d"),
                'Password' => $Password
            ));

            $this->Login();

            //Find the original URL
            $URL = $_POST['namURL'];

            // Return to other page
            header("location: $URL");

        }else{
            echo "Erreur de mots de passe";
        }



    }


    public function addComment($comment, $evaluation, $pseudo, $idCif)
    {
        $reqAddComment = $this->db->prepare('INSERT INTO `t_evaluation`(`idEvaluation`, `evaNote`, `evaComment`, `fkCIF`, `fkMember`) VALUES (NULL,:evaluation,:comment,:fkCIF,(SELECT idMember FROM t_member WHERE memPseudo = :pseudo))');
        $reqAddComment->execute(array(
            'evaluation' => $evaluation,
            'comment' => $comment,
            'fkCIF' => $idCif,
            'pseudo' => $pseudo
        ));

        //Find the original URL
        $URL = $_POST['URL'];

        // Return to other page
        header("location: $URL");
    }

}//END DbAcces