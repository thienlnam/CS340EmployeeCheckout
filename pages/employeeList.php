<?php
echo '
<!DOCTYPE html>
<html>
<title>Employee Timesheets</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../assets/css/main.css">
<link rel="stylesheet" href="../assets/css/employeeList.css">
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="index.php" class="w3-bar-item w3-button"><b>Employee</b> Timesheets</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="#projects" class="w3-bar-item w3-button">Sites</a>
    <!--  <a href="#about" class="w3-bar-item w3-button">About</a>
      <a href="#contact" class="w3-bar-item w3-button">Contact</a>
    -->
    </div>
  </div>
</div>
<br><br>
<h2>Employee List and  Groups</h2>
<br>
';
require_once('../dbFunctions.php');
$db = new dbfunctions();



echo' 
<div class="container">
  <div class="row">
    <div class="col">
      <div class="table-responsive">
        <table summary="This table shows how to create responsive tables using Bootstraps default functionality" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Phone Number</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          ';



       
        $result = $db->selectEmployees();
        
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              echo '<tr>';
              echo '<td>'. $row['employeeID'] .'</td>';
              echo '<td>'. $row['firstName'] .'</td>';
              echo '<td>'. $row['lastName'] .'</td>';
              echo '<td>'. $row['phone'] .'</td>';
              echo '<td>'. $row['email'] .'</td>';
              echo '<td><form action="../modules/delete.php" method="post" id="form1"><input name="action" value="deleteEmployee" style="display:none"><button type="submit" form="form1" name="UID" value="'. $row['employeeID'].'">Delete</button></form><form action="./editEmployee.php" method="post" id="form2"><button type="submit" form="form2" name="UID" value="'. $row['employeeID'].'">Edit</button></form></td>';
              echo '</tr>';
            }
        } else {
          echo '
          No data
          
          ';
        }
          
        /*
          <td>$row['employeeID']</td>
          <td>$row['firstName']</td>
          <td>$row['lastName']</td>
          <td>$row['phone']</td>
          <td>$row['email']</td>
        */


          echo '
          </tbody>
          <tfoot>
            <tr>
              <td colspan="6" class="text-center">Live data from database </td>
            </tr>
          </tfoot>
        </table>
      </div><!--end of .table-responsive-->
    </div>
  </div>
</div>
<br><br>
<h2>Groups</h2>
<br><br>';

        $result = $db->selectEmployeeGroupsList();

        echo '            
        <div class="container">
        <div class="row">
          <div class="col-sm-9">
            <div class="table-responsive">
              <table summary="This table shows how to create responsive tables using Bootstraps default functionality" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Group Name</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>';
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $eID = $row['employeeID'];
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $phoneNumber = $row['phone'];
                $email = $row['email'];
                $groupName = $row['groupName'];
                $groupID = $row['groupID'];
                echo '

                          <tr>
                            <td>'. $eID .'</td>
                            <td>'. $firstName .'</td>
                            <td>'. $lastName .'</td>
                            <td>'. $phoneNumber .'</td>
                            <td>'. $email .'</td>
                            <td>'. $groupName .'</td>
                            <td><form action="../modules/delete.php" method="post"><input name="action" value="deleteFromGroup" style="display:none"><input name="UID" value="'.$eID.'" style="display:none"><button type="submit" name="IDgroup" value="'. $groupID.'">Remove</button></form></td>
                          </tr>
                  ';
            }

        }

        echo '
        </tbody>
        <tfoot>
          <tr>
            <td colspan="7" class="text-center">Group Data</td>
          </tr>
        </tfoot>
      </table>
          </div><!--end of .table-responsive-->
        </div>
        <div class="col-sm-3">
        <div class="table-responsive">
        <table summary="This table shows how to create responsive tables using Bootstraps default functionality" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Group ID</th>
              <th>Group Name</th>
            </tr>
          </thead>
          <tbody> ';
          $result = $db->selectGroupsList();
          if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
             
              $gid = $row['groupID'];
              $groupName = $row['groupName'];
              echo '

                        <tr>
                          <td>'. $gid .'</td>
                          <td>'. $groupName .'</td>
                        </tr>
                ';
            }

        }


          echo '
          </tbody>
          <tfoot>
            <tr>
              <td colspan="2" class="text-center">Existing Groups</td>
            </tr>
          </tfoot>
        </table>
        </div>
    
      </div>
      </div>
        ';



echo '

  <div id="buttons">
    <a href="./addEmployee.php" class="btn green">Add Employee</a>
    <a href="./addToGroup.php" class="btn blue">Add Employee To Group</a>
    <button id="addgroup" class="btn yellow">Add Group</button>
</div>
</body>
</html>
';

mysqli_close($mysqli);

?>

<script>
   $(document).ready(function(){
        $("#addgroup").click(function(){
          var groupName = prompt("Please enter a group name", "");
          if (groupName === ""){
            alert("Input was empty!  Please enter a valid name");
            return;
          } else if (groupName){

          }
          else {
            return;
          }
 
 $.ajax({
        url: "../modules/insert.php",
        type: "post",
        data: {
          action: "addGroup",
          groupName: groupName
        },

        success: function (response) {
            alert(response);
           // You will get response from your PHP page (what you echo or print)
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
    
  });
});
</script>
