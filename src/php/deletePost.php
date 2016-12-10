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

	include("_Layout/layout_header.php");
    include("_Layout/layout_menu.php");

        // Include the class and create the work variable
        include("Class/DbAccess.php");
        $work = new DbAccess();

        $work->deletePostById($_GET['id']);

        $URL = $_GET['url'];

        header("location: $URL&name=$_GET[name]")

        ?>