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
        //$query = 'SELECT * FROM t_forum Where forAddiction = 0';
        $query = 'SELECT * FROM t_forum ORDER BY forAddiction';

        // send the request in the right function and store the result in a variable
        $value = $this->executeSqlRequest($query);

        return $value;
    }// end function getAllForumsFirstLevel

    /**
     * Count the number of subjects in the forum pass in parameter
     * @param $Name = the name of the forum we want count the number of subject
     * @return array = return the number of subjects
     */
    public function getNbrSubjectsInTheForum($Name){
        // Define the query
        $query = "SELECT COUNT(subTitle) AS nbrSubjects FROM t_forum natural join t_subject Where forName = '$Name'";
        //$query = "SELECT forName, COUNT(subTitle) AS nbrSubjects FROM t_forum natural join t_subject GROUP BY idForum";

        // send the request in the right function and store the result in a variable
        $value = $this->executeSqlRequest($query);

        return $value;
    }// End function getNbrSubjectsInTheForum

    /**
     * This function allow a member to connect
     */
    public function Login()
    {
        // Store all members in $reqMember
        $reqMember = 'SELECT memPseudo,memPassword,graAccreditation FROM t_member NATURAL JOIN t_grade';
        $members = $this->executeSqlRequest($reqMember);

        // testing if the variable is set
        if ($_POST['userName'] != null && $_POST['userPassword'] != null) {


            // Check if the member is registered
            foreach($members as $member){
            //while($member = $members->fetch()){
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
                    //$_SESSION['rankAccreditation'] = $member['graAccreditation'];

                    // disengage the error message
                    $Error = false;

                    //print $_SESSION['namPseudo'];


                    //Find the original URL
                    //$URL = $_POST['namURL'];

                    // Return to other page
                    //header("location: $URL");

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

            //$this->Login();

            //Find the original URL
            //$URL = $_POST['namURL'];

            // Return to other page
            //header("location: $URL");
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

    public function getIdMember($name){
        // Define the sql Request
        $req = "SELECT idMember from t_member where memPseudo = '$name'";

        // Execute sql request
        $result = $this->executeSqlRequest($req);

        return $result;
    }
} 