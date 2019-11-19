<?php
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

    /* SELECT FUNCTIONS */
    function selectEmployees() {
        $mysqli = dbConnect();

        $query = "SELECT * FROM `employees`";
        $result = $mysqli->query($query);
        return $result;
    }



    /* INSERT FUNCTIONS */
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


?>