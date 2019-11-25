<?php
/* Attempt MySQL server connection. Assuming you are running MySQL */
require_once('../dbFunctions.php');
$UID = $_POST['UID'];
echo $UID;

$db = new dbfunctions();
    
// Escape user inputs for security
$UID = $_POST['UID'];
echo $UID;
$db->deleteEmployee($UID);
    
?>
