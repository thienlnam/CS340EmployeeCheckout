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
<h2>Employee List and Groups</h2>
<br>
';
require_once('../dbFunctions.php');




echo' 
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
        <table summary="This table shows how to create responsive tables using Bootstraps default functionality" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Phone Number</th>
              <th>Email</th>
            </tr>
          </thead>
          <tbody>
          ';



        $db = new dbfunctions();
        $result = $db->selectEmployees();

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
               echo '<tr>';
               echo '<td>'. $row['employeeID'] .'</td>';
               echo '<td>'. $row['firstName'] .'</td>';
               echo '<td>'. $row['lastName'] .'</td>';
               echo '<td>'. $row['phone'] .'</td>';
               echo '<td>'. $row['email'] .'</td>';
               
               echo '</tr>';
            }
        } else {
          echo '
          <td>hi</td>
          <td>hi</td>
          <td>hi</td>
          <td>hi</td>
          <td>hi</td>
          
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
              <td colspan="5" class="text-center">Live data from database </td>
            </tr>
          </tfoot>
        </table>
      </div><!--end of .table-responsive-->
    </div>
  </div>
</div>
<br><br>
<h2>Group Example</h2>
<br><br>
<div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="table-responsive">
          <table summary="This table shows how to create responsive tables using Bootstraps default functionality" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Example Entry</td>
                <td>Example Entry</td>
                <td>Example Entry</td>
                <td>Example Entry</td>
                <td>Example Entry</td>
              </tr>
              <tr>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
              </tr>
              <tr>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
              </tr>
              <tr>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
              </tr>
              <tr>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
              </tr>
              <tr>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
                  <td>Example Entry</td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="5" class="text-center">Data Not Yet Live </td>
              </tr>
            </tfoot>
          </table>
        </div><!--end of .table-responsive-->
      </div>
    </div>
  </div>

  <div id="buttons">
    <a href="./addEmployee.php" class="btn green">Add Employee</a>
    <a href="./addToGroup.php" class="btn blue">Add Employee To Group</a>
</div>
</body>
</html>
';

mysqli_close($mysqli);

?>
