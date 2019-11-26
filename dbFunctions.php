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
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }
    
    /*Delete Employee*/
    function deleteEmployee($uid){
        $sql = "DELETE FROM `employees` WHERE `employeeID` = $uid";
        if($this->conn->query($sql) === TRUE){
            echo "Recorded delete successfully.";
        }else{
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
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
