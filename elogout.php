<?php 

require_once 'php/ecore.php';

// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

header('location: http://localhost/AP-AGRO/emplogin.php');	

?>