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
     * Check in Database if the user exists and the information entered is correct
     * @param $username = This is the username of the user
     * @param $password = This is the password of the user
     * @return bool
     */
    public function login($username, $password)
    {
        //Execute sql request to select all datas about member
        $this->connectDB();
        $sqlRequest = 'SELECT memName, memPassword, memPrivilege FROM t_member';
        $tableMember = $this->executeSqlRequest($sqlRequest);
        $this->deconnectDB();


        //Run all members in the table (normaly there's only one) /!\--TEST--/!\
        for($i = 0 ; $i < count($tableMember); $i++)
        {
            //If password and username are the same return true
            if($tableMember[$i]['memName'] == $username AND password_verify($password, $tableMember[$i]['memPassword']))
            {
                return true;
            }
            //Else, return false
            else
            {
                return false;
            }
        }

    }//End function login
} 