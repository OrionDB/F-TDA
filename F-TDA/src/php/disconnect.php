<?php
/*
Author : Yvan Cochet
Summary : Page to disconnect a user
Date : 20.04.2016
*/

//Start session to get $_SESSION
session_start();

//Destroy the session
session_destroy();

//Redirect to home page
header("location: ./listTeacher.php");
