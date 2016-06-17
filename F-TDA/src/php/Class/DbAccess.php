<?php
/*
Author : Daniel Baltensperger
Summary : Php Class for Interact with the database
Date : 01.06.2016
*/

class DbAccess {

    // variable for store the connection with the database
    private $db;

    /**
     * Make a connection with the db
     */
    private function connectDB(){
        //Var to access db
        $login = 'root';
        $password = '';
        $host = 'localhost';
        $dbName = 'db_alpha';

        //Connection to the DB with UTF8
        $this->db = new PDO(sprintf('mysql:host=%s;dbname=%s', $host, $dbName), $login, $password, array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }// End function connectDB

    /**
     * Function for unconnected the database
     */
    private function untieDB()
    {
        $this->db = null;
    }// End function untieDB

    /**
     * Function that execute a sql request
     * @param $sqlRequest = this is the sql request we want execute
     * @return array with the result of the request
     */
    private function executeSqlRequest($sqlRequest)
    {

        $this->connectDB();

        $req = $this->db->prepare($sqlRequest);
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        $this->untieDB();

        return $datas;

    }// End function executeSqlRequest

    /**
     * This function gets all the information about the first level of forums
     * @return array
     */
    public function getAllForumsFirstLevel(){
        // Define the request
        $query = 'SELECT * FROM t_forum ORDER BY forAddiction';

        // send the request in the right function and store the result in a variable
        $value = $this->executeSqlRequest($query);

        return $value;
    }// end function getAllForumsFirstLevel

    /**
     * This function allow a member to connect
     */
    public function Login()
    {
        echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />";

        // Store all members in $reqMember
        $reqMember = 'SELECT memPseudo,memPassword,graAccreditation FROM t_member NATURAL JOIN t_grade';
        $members = $this->executeSqlRequest($reqMember);

        // testing if the variable is set
        if ($_POST['userName'] != null && $_POST['userPassword'] != null) {


            // Check if the member is registered
            foreach($members as $member){
                if ($member['memPseudo'] == $_POST['userName'] && password_verify($_POST['userPassword'],$member["memPassword"])) {
                    // We start the Session
                    session_start ();

                    // We store his function accreditation in an array
                    $funAcc = $this->getFunctionAccreditationByUserName($member['memPseudo']);

                    // Save the information of our member like session variable
                    $_SESSION['namPseudo'] = $member['memPseudo'];

                    $rankAcc = array();

                    for($u = $member['graAccreditation'];$u >=0;$u--){
                        $rankAcc[] = $u;
                    }

                    $_SESSION['Accreditation'] = $funAcc;
                    $_SESSION['rankAccreditation'] = $rankAcc;

                    // disengage the error message
                    $Error = false;
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

    /**
     * This function add a member into the database
     */
    public function addMember(){
        // Check if the password entered is the same
        if($_POST['iPassword'] == $_POST['iPassword2']){

            $Password = $this->hashPassword($_POST['iPassword']);
            $Pseudo = $_POST['iPseudo'];
            $Mail = $_POST['iMail'];
            $Date = date("Y-m-d");

            $req = "INSERT INTO db_alpha.t_member (idMember, memPseudo, memMail, memEnterDate, memPassword, memVarious, idGrade) VALUES (NULL, \"$Pseudo\", \"$Mail\", \"$Date\", \"$Password\", NULL , \"3\");";

            $this->executeSqlRequest($req);

            // Define the Post variable for login
            $_POST['userName'] = $Pseudo;
            $_POST['userPassword'] = $_POST['iPassword'];

            $this->Login();

            // Return to other page
            header("location : forums.php");

        }else{
            echo "Erreur de mots de passe";
        }



    }// End addMember

    /**
     * This function will hash a string
     * @param $pass = the string we want hash
     * @return bool|string = The result of the hashing
     */
    public function hashPassword($pass){

        $hash = (password_hash($pass,PASSWORD_BCRYPT));
        return $hash;
    }// End hashPassword

    /**
     * Get the accreditation number of the member function
     * @param $userName
     * @return array
     */
    public function getFunctionAccreditationByUserName($userName){

        // Define the sql request
        $req = "SELECT funAccreditation from t_member natural join have natural join t_function where memPseudo = '$userName'";

        // Execute sql Request
        $result = $this->executeSqlRequest($req);

        // return the answer
        return $result;
    }// End getFunctionAccreditationByUserName

    /**
     * This function will get all the subject contains in a forum
     * @param $forName = this is the name of the forum
     * @return array = this is an array with the result of the function
     */
    public function getSubjectsByForumName($forName){

        // Define the Sql Request
        $req = "Select idSubject, subTitle, idMember, memPseudo from t_subject natural join t_forum natural join t_member where forName = '$forName'";

        // Execute the sql request
        $result = $this->executeSqlRequest($req);

        // return the answer
        return $result;
    }// End getSubjectsByForumName

    /**
     * This function will get all the name and the number of subject
     * @return array
     */
    public function getNbrSubjectsInAllForums(){
        $req = "SELECT forName, count(idSubject) as NbrSubject FROM t_Subject right join t_forum on t_forum.idForum = t_subject.idForum group by forName";
        $result = $this->executeSqlRequest($req);
        return $result;
    }// End getNbrSubjectsInAllForums





    /**
     * This function will return an array with all the member ordered by the grade
     * @return array
     */
    public function getMemberslist(){
        // Define the sql request
        $req = "Select memPseudo, memEnterDate, graName, funName, graColor from t_member natural join t_grade inner join t_function on idFunction = mempFunction order by graAccreditation desc";

        // Execute the request
        $result = $this->executeSqlRequest($req);

        return $result;
    }// End getMembersList

    /**
     * This function will return all the information about a member
     * @param $memberName
     * @return array
     */
    public function getMemberByName($memberName){

        // Define the Sql Request
        $req = "SELECT memPseudo, memEnterDate, memVarious, graName, funName, graColor, memMail from t_member natural join t_grade inner join t_function on idFunction = memPFunction  where memPseudo = '$memberName'";
        $req2 = "SELECT count(idPost) as nbrPost from t_post natural join t_member where memPseudo = '$memberName'";

        // Execute the sql request
        $result = $this->executeSqlRequest($req);
        $result2 = $this->executeSqlRequest($req2);

        // Fusion between the two result
        $result[1] = $result2;

        return $result;
    }// End getMemberByName

    /**
     * This function will update the user
     * @param $pseudo
     * @param $mail
     * @param $various
     * @param $id
     * @return array
     */
    public function updateMember($pseudo, $mail, $various, $id){

        // Define the sql Request
        $req = "UPDATE t_member SET memPseudo = '$pseudo', memMail = '$mail', memVarious = '$various' WHERE t_member.idMember = '$id';";

        // Execute sql request
        $result = $this->executeSqlRequest($req);

        return $result;

    }// End updateMember

    /**
     * This function will return the id of a user by this name
     * @param $name = The name of the user
     * @return array = Contains the id of the user
     */
    public function getIdMember($name){
        // Define the sql Request
        $req = "SELECT idMember from t_member where memPseudo = '$name'";

        // Execute sql request
        $result = $this->executeSqlRequest($req);

        return $result;
    }// End getIdMember

    /**
     * This function allow the user to chage his password
     * @param $name = this is he name of the user
     */
    public function setNewPassword($name){

        echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />";

        // Define a first sql request for finding the current password
        $req = "SELECT memPassword FROM t_member WHERE memPseudo = '$name'";

        // Execute and store the password
        $password = $this->executeSqlRequest($req);

        // Check if current password is correct
        if(password_verify($_POST["iPassworda"],$password[0]["memPassword"])){

            // Check if the two new password enter by the user is the same
            if($_POST['iPassword'] == $_POST['iPassword2']){
                // Hash new password
                $newPassHash = $this->hashPassword($_POST['iPassword']);

                // Define the request for update the password
                $upPass = "UPDATE t_member SET memPassword = '$newPassHash' WHERE memPseudo = '$name'";

                // Execute the request
                $this->executeSqlRequest($upPass);

                // inform and redirect
                echo '<body onLoad="alert(\'Mot de passe changé\')"> ';
                echo '<meta http-equiv="refresh" content="0;URL=myProfile.php">';

            }else{
                // inform and redirect
                echo '<body onLoad="alert(\'Les deux mots de passe rentrés ne sont pas identique\')"> ';
                echo '<meta http-equiv="refresh" content="0;URL=myProfile.php">';
            }

        // if current password is not correct
        }else{
            // inform and redirect
            echo '<body onLoad="alert(\'Votre mot de passe actuel est erroné\')"> ';
            echo '<meta http-equiv="refresh" content="0;URL=myProfile.php">';
        }
    }// End setNewPassword

    /**
     * This function will get all the posts contains in a subject
     * @param $id = This is the id of the subject
     * @return array
     */
    public function getAllPostsBySubjectId($id){

        // Define the Sql Request
        $req="SELECT posText, memPseudo, memPFunction, graName, funName, idSubject, graColor, idPost from t_post natural join t_member natural join t_grade inner join t_function on idFunction = memPFunction Where idSubject = '$id' AND posIsDeleted = 0 order by idPost";

        // Execute the request
        $result = $this->executeSqlRequest($req);

        return $result;
    }// End getAllPostsBySubjectId

    /**
     * This function allow create a post
     * @param $name = this is the name of the user
     * @param $post = This is the content of the post
     * @param $topic = This is the subject of the post
     */
    public function addPost($name, $post, $topic){
        // Define the current time
        $date = date("d.m.Y-H:i");

        // define the sql request
        $req = "INSERT INTO db_alpha.t_post (idPost, posText, posDate, idMember, idSubject) VALUES (NULL, '$post', '$date',(SELECT idMember from t_member where memPseudo = '$name'), '$topic')";
        //INSERT INTO `db_alpha`.`t_post` (`idPost`, `posText`, `posDate`, `posIsDeleted`, `idMember`, `idSubject`) VALUES (NULL, 'sefsfefefsdfsefsefsef', '31.05.2016-18:30', '0', '12', '29');

        // Execute Request
        $this->executeSqlRequest($req);

        return ;
    }// End addPost

    /**
     * This function will set the attribute posIsDeleted to 1 for forget this post to be printed
     * @param $id = Thois is the id of the post we will hide;
     */
    public function deletePostById($id){

        $req = "UPDATE t_post SET posIsDeleted = '1' WHERE idPost = '$id';";

        $this->executeSqlRequest($req);

        return;
    }// End deletePostById

    /**
     * This function will validate and do the edit of the post
     * @param $id
     * @param $text
     */
    public function editPostById($id, $text){

        $req = "UPDATE t_post SET posText = '$text' WHERE idPost = '$id';";
        $this->executeSqlRequest($req);
        return;
    }// End editPostById

    /**
     * This function allow find a post with this id
     * @param $id
     * @return array
     */
    public function findPostById($id){
        $req = "SELECT posText FROM t_post where idPost = '$id'";
        $result = $this->executeSqlRequest($req);
        return $result;
    }// End findPostById

    /**
     * This function will reverse te translate of BBCode into HTML
     * @param $text
     * @return mixed
     */
    public function reverseBBCode($text){

        $text = str_replace("<i>","[i]",$text);
        $text = str_replace("</i>","[/i]",$text);
        $text = str_replace("</u>","[/u]",$text);
        $text = str_replace("<u>","[u]",$text);
        $text = str_replace("<b>","[b]",$text);
        $text = str_replace("</b>","[/b]",$text);
        $text = str_replace("<span style=\"color: ","[color = \"",$text);
        $text = str_replace("\">","\"]",$text);
        $text = str_replace("</span>","[/color]",$text);

        return $text;
    }// End reverseBBCode

    /**
     * This function will translate the code into BBCode
     * @param $text
     * @return string
     */
    public function translateBBCode($text){

        $text = str_replace("[i]","<i>",$text);
        $text = str_replace("[/i]","</i>",$text);
        $text = str_replace("[/u]","</u>",$text);
        $text = str_replace("[u]","<u>",$text);
        $text = str_replace("[b]","<b>",$text);
        $text = str_replace("[/b]","</b>",$text);
        $text = str_replace("[color = \"","<span style=\"color: ",$text);
        $text = str_replace("\"]","\">",$text);
        $text = str_replace("[/color]","</span>",$text);

        return $text;
    }// End translateBBCode

    /**
     * This function will return the Accreditation number of the forum
     * @param $id
     * @return array
     */
    public function getForAccreditationById($id){
        $req = "SELECT forAccreditation FROM t_Subject natural join t_forum where idSubject = '$id'";
        $result = $this->executeSqlRequest($req);
        return $result;
    }// End getForAccreditationById

    /**
     * This function will return the name and the date of the last post
     * @param $subName = This is the subject name
     * @return array
     */
    public function getLastPostInSubject($subName){

        $req = "SELECT posDate,  memPseudo, subTitle FROM t_subject left outer join t_post on t_post.idSubject = t_subject.idSubject inner join t_member on T_post.idMember = t_member.idMember natural join t_forum where posIsDeleted = 0 AND subTitle = '$subName' order by posDate desc Limit 1";
        $result = $this->executeSqlRequest($req);
        return $result;
    }// End getLastPostInSubject

    /**
     * This function will get all the answer for all the subject in a forum
     * @param $name = The name of the forum we want the answer number by subject
     * @return array
     */
    public function getAllNbrAnswerByForumName($name){

        $req = "SELECT subTitle,count(idPost) as nbrAnswer from t_post inner join t_subject on t_post.idSubject = t_subject.idSubject natural join t_forum where posIsDeleted = 0 AND forName = '$name' group by subTitle";
        $result = $this->executeSqlRequest($req);
        return $result;
    }

    /**
     * This function will create a topic
     * @param $name = The name of the topic
     * @param $forum = the forum where the topic are create
     * @param $author = The id of the author
     * @param $post = The main post
     */
    public function createTopic($name, $forum, $author, $post){

        echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />";

        $req = "INSERT INTO db_alpha.t_subject (idSubject, subTitle, idMember, idForum) VALUES (NULL, '$name', (SELECT idMember from t_member where memPseudo = '$author'), (SELECT idForum from t_forum where forName ='$forum'));";
        $this->executeSqlRequest($req);

        //echo $name." ".$forum." ".$author." ".$post;

        $req2 = "SELECT idSubject FROM t_subject order by idSubject desc limit 1";

        $id = $this->executeSqlRequest($req2);

        print_r($id);

        $topic = $id[0]['idSubject'];

        $this->addPost($author,$post,$topic);

        return $topic;
    }// End createTopic

    /**
     * This function will get all the Forum Name
     * @return array
     */
    public function getAllForumsNameAndAddiction(){

        $req = "SELECT forName, forAddiction FROM t_forum";
        $result = $this->executeSqlRequest($req);
        return $result;
    }// End getAllForumsName

    public function createForum($name, $desc, $own, $acc){

        $forums = $this->getAllForumsNameAndAddiction();

        $i = 0;

        $cadd = 0;

        $add = null;

        if($own == "Root"){



            foreach($forums as $forum){
                if(ctype_digit($forum['forAddiction']) == true){
                    $i++;
                }
            }

            $cadd = $i;

        }else{
            foreach($forums as $forum){
                if($forum['forName'] == $own){
                    $add = $forum['forAddiction'];
                }

                if(isset($add)){
                    foreach($forums as $searchAdd){
                        if(preg_match("/^[$add][.][0-9]{1}$/",$searchAdd['forAddiction'])){
                            $i += 1;
                        }
                    }
                }
            }

            $cadd = $add.".".$i +0.1;
        }

        $req = "INSERT INTO t_forum (idForum, forName, forAddiction, forDescription, forAccreditation) VALUES (NULL, '$name', '$cadd', '$desc', '$acc');";

        $this->executeSqlRequest($req);

        $req2 = "SELECT idForum FROM t_forum order by idForum desc limit 1";

        $topic = $this->executeSqlRequest($req2);

        return $topic;


    }// End createForum

    public function test(){
        $req="CALL gamma();";
        return $this->executeSqlRequest($req);
    }



}