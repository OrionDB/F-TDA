<?php
session_start ();

$URL = $_SESSION['URL'];

// Destroy the variable store in the session (NEVER FORGET)
session_unset ();
// Destroy the Session
session_destroy ();

// Return to main page
header ("location: $URL");
?>
