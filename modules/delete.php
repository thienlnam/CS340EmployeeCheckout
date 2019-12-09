<?php
/* Attempt MySQL server connection. Assuming you are running MySQL */
require_once('../dbFunctions.php');
$db = new dbfunctions();


if ($_POST['action'] == "deleteEmployee"){
    // Escape user inputs for security
    $UID = $_POST['UID'];
    //echo $UID;
    $db->deleteEmployee($UID);
} else if ($_POST['action'] == "deleteFromGroup"){
    $UID = $_POST['UID'];
    $GID = $_POST['IDgroup'];
    $db->deleteEmployeeFromGroup($UID, $GID);
}

    
?>
