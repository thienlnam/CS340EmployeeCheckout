<?php
/* Attempt MySQL server connection. Assuming you are running MySQL */
require_once('../dbFunctions.php');
 

$db = new dbfunctions();

if ($_POST['action'] == "insertEmployee"){

    // Escape user inputs for security
    $first_name = $_POST['first'];
    $last_name = $_POST['last'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    

    $db->insertIntoEmployees($first_name, $last_name, $email, $phone);
} else if ($_POST['action'] == "addGroup"){ 
    $groupName = $_POST['groupName'];
    $db->insertIntoGroups($groupName);

} else if ($_POST['action'] == "insertEmployeeIntoGroup"){
    $userID = $_POST['employeeID'];
    $groupID = $_POST['groupID'];
    $db->insertEmployeeIntoGroups($userID, $groupID);
} else if ($_POST['action'] == "insertShiftToBeCovered"){
    $date = $_POST['date'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $additionalInfo = $_POST['additionalInfo'];
    $shiftID = $_POST['shiftID'];
    $employeeID = $_POST['employeeID'];
   
    $db->insertShiftIntoRequests($employeeID, $shiftID, $date, $startTime, $endTime, $additionalInfo);

}
?>
