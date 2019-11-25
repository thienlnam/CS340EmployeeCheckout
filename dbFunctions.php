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
    
    /*Insert Employee*/
    function insertIntoEmployees($first, $last, $email, $phone){
        $stmt = $this->conn->prepare("INSERT INTO employees (firstName, lastName, email, phone) VALUES (?,?,?,?)");
        $stmt->bind_param($first, $last, $email, $phone);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    
    /*Delete Employee*/
    function deleteEmployee($uid){
        $stmt = $this->conn->prepare("DELETE FROM `employees` WHERE 'employeeID' == ?");
        $stmt->bind_param($uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    
    /* Update Employee*/
    function updateEmployee($uid, $firstname, $lastname, $email, $phone){
        $stmt = $this->conn->prepare("UPDATE `employees` SET `firstName`=?,`lastName`=?,`email`=?,`phone`=? WHERE 'employeeID' == ?");
        $stmt->bind_param($firstname, $lastname, $email, $phone, $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt-close();
        return $result;
    }
}
    
    
    
    
    
   /*
    function dbConnect() {
        require_once('../config.php');

        $mysqli = new mysqli($server, $user, $password, $databaseName);
        if (!$mysqli->set_charset("utf8")) {
            printf("Error loading character set utf8 : %s\n", $mysqli->error);
        }

        if (!$mysqli) {
			echo "<p>Could not connect to the server '" . $databaseName . "'</p>\n";
        	echo mysql_error();
		}
        
        return $mysqli;
    }

    /* SELECT FUNCTIONS *
    function selectEmployees() {
        $mysqli = dbConnect();

        $query = "SELECT * FROM `employees`";
        $result = $mysqli->query($query);
        return $result;
    }



    /* INSERT FUNCTIONS *
    function insertIntoEmployees($first, $last, $email, $phone){
        $mysqli = dbConnect();
        // Attempt insert query execution
        $sql = "INSERT INTO employees (firstName, lastName, email, phone) VALUES ('$first', '$last', '$email', $phone)";
        if(mysqli_query($mysqli, $sql)){
            echo "Records added successfully.";
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
        
    }
    */

?>
