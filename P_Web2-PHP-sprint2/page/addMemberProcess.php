<?php
/*
Author : Daniel baltensperger
Summary : Treatement to add a comment
Date : 19.04.2016
*/

//Include
include("../class/DbAcces.php");

//New dbAcces object and connect the db
$db = new DbAcces();
$db->connectDB();

//If
if(isset($_POST['namPseudo'])) {
    $db->Login();
}elseif(isset($_POST['namPseudom'])){
    if($_POST['namPasswordm'] == $_POST['namPassword2']) {
        $_POST['namPseudo'] = $_POST['namPseudom'];
        $_POST['namPassword'] = $_POST['namPasswordm'];
        $db->addMember();
    }else{
        echo "Les mots de passe ne sont pas identique";
    }
}
?>
