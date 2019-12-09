<?php
class dbfunctions {
    private $conn;
    
    //constructor
    function __construct(){
        require_once dirname(__FILE__) . '/config.php';
        require_once dirname(__FILE__) . '/dbconnect.php';
        
        //now lets connect
        $db = new dbconnect();
        $this->conn = $db->connect();
    }
    
    /*Select all employees*/
    function selectEmployees(){
        $stmt = $this->conn->prepare("SELECT * FROM `employees`");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    function selectEmployeeFromID($uid){
        $stmt = $this->conn->prepare("SELECT * FROM `employees` WHERE employeeID = $uid");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /*Select all existing user groups */
    function selectEmployeeGroupsList(){
        $stmt = $this->conn->prepare("SELECT employees.employeeID, employees.firstName, employees.lastName, employees.email, employees.phone, employees.PTO, employeeGroups.groupID, groups.groupName FROM employees, employeeGroups, groups WHERE employeeGroups.employeeID = employees.employeeID AND employeeGroups.groupID = groups.GroupID ORDER BY groupID ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    
    /* Select List of groups */
    function selectGroupsList(){
        $stmt = $this->conn->prepare("SELECT * FROM `groups` ORDER BY groupID ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /* Select Group name by ID*/
    function selectEmployeeGroupFromID($id){
        $stmt = $this->conn->prepare("SELECT groupName FROM `groups` WHERE GroupID = $id");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /* Select all shifts and types */
    function selectEmployeeShifts(){
        $stmt = $this->conn->prepare("SELECT * FROM `employeeShifts`, employees WHERE employeeShifts.employeeID = employees.employeeID ORDER BY lastName ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /* Select shift by ID */
    function selectEmployeeShiftFromID($id){
        $stmt = $this->conn->prepare("SELECT * FROM `employeeShifts`, employees WHERE employeeShifts.employeeID = employees.employeeID AND employeeShifts.scheduleID = $id");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }


    /*Insert Employee*/
    function insertIntoEmployees($first, $last, $email, $phone){
        /*
        $stmt = $this->conn->prepare("INSERT INTO employees (firstName, lastName, email, phone) VALUES ("?","?","?","?")");
        $stmt->bind_param($first, $last, $email, $phone);

        if($stmt->execute()){
            echo "Record inserted successfully.";
        }
        else {
            print_r($stmt);
            echo "$first, $last, $email, $phone: ";
            echo "ERROR: Unable to insert";
        }
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
        */

        $sql = "INSERT INTO employees (firstName, lastName, email, phone) VALUES ('$first','$last','$email','$phone')";
        if ($this->conn->query($sql) === TRUE) {
            echo "New record created successfully<br>";
            echo '<a href="http://web.engr.oregonstate.edu/~namt/cs340/pages/employeeList.php">Back to employee list</a>';
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    /* Insert New Group */
    function insertIntoGroups($groupName){
        $sql = "INSERT INTO groups (groupName) VALUES ('$groupName')";
        if ($this->conn->query($sql) === TRUE) {
            echo "New group added successfully! Refresh to see changes.";
            
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    function insertEmployeeIntoGroups($uid, $gid){
        $sql = "INSERT INTO employeeGroups (employeeID, groupID) VALUES ('$uid', '$gid')";
        if ($this->conn->query($sql) === TRUE) {
            echo "User added into group successfully.<br>";
            echo '<a href="http://web.engr.oregonstate.edu/~namt/cs340/pages/employeeList.php">Back to employee list</a>';
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }
    
    function insertShiftIntoRequests($employeeID, $shiftID, $date, $startTime, $endTime, $additionalInfo){
        $sql = "INSERT INTO employeeRequests (employeeID, scheduleID, dateToGetCovered, timeStart, timeEnd, requestDetails) VALUES ('$employeeID', '$shiftID', '$date', '$startTime', '$endTime', '$additionalInfo')";
        if ($this->conn->query($sql) === TRUE) {
            echo "Shift covering requested successfully.<br>";
            echo '<a href="http://web.engr.oregonstate.edu/~namt/cs340/pages/employeeList.php">Back to employee list</a>';
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    /*Delete Employee*/
    function deleteEmployee($uid){
        $sql = "DELETE FROM `employees` WHERE `employeeID` = $uid";
        if($this->conn->query($sql) === TRUE){
            echo "Recorded delete successfully.<br>";
            echo '<a href="http://web.engr.oregonstate.edu/~namt/cs340/pages/employeeList.php">Back to employee list</a>';
        }else{
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    /*Delete Employee Group*/
    function deleteEmployeeFromGroup($uid, $gid){
        $sql = "DELETE FROM `employeeGroups` WHERE `employeeID` = $uid AND `groupID` = $gid"; 
        if($this->conn->query($sql) === TRUE){
            echo "Employee successfully removed from group.<br>";
            echo '<a href="http://web.engr.oregonstate.edu/~namt/cs340/pages/employeeList.php">Back to employee list</a>';
        }else{
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }
    
    /* Update Employee*/
    function updateEmployee($uid, $firstname, $lastname, $email, $phone){
        /*
        $stmt = $this->conn->prepare("UPDATE `employees` SET `firstName`=?,`lastName`=?,`email`=?,`phone`=? WHERE 'employeeID' == ?");
        $stmt->bind_param($firstname, $lastname, $email, $phone, $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt-close();
        return $result;
        */
        
        $sql = "UPDATE `employees` SET firstName = '$firstname', lastName = '$lastname', email = '$email', phone = '$phone' WHERE employeeID = $uid";
        if ($this->conn->query($sql) === TRUE) {
            echo "Record successfully updated<br>";
            echo '<a href="http://web.engr.oregonstate.edu/~namt/cs340/pages/employeeList.php">Back to employee list</a>';
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }





















}
    
    
    
    

?>
