<?php
/* Attempt MySQL server connection. Assuming you are running MySQL */
require_once('../dbFunctions.php');
 

$db = new dbfunctions();
    
// Escape user inputs for security
$uid = $_POST['uid'];
$first_name = $_POST['first'];
$last_name = $_POST['last'];
$email = $_POST['email'];
$phone = $_POST['phone'];
 
$db->updateEmployee($uid, $first_name, $last_name, $email, $phone);
    
?>
