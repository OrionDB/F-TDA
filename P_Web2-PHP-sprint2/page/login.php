<?php
/**
 * Created by PhpStorm.
 * User: baltenspda
 * Date: 15.03.2016
 * Time: 14:08
 */

include("../class/DbAcces.php");

$db = new DbAcces();
$db->connectDB();
$db->Login();
?>