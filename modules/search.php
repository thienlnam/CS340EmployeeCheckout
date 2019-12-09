<?php
/* Attempt MySQL server connection. Assuming you are running MySQL */
require_once('../dbFunctions.php');
$db = new dbfunctions();

//Checks to see if the user has pressed the search button
if($_POST['action'] == "shiftRequestSearch"){
    //When the user presses this button, we run a search query
    $searchTerm = $_POST['search_value'];
    

    $result = $db->selectSearchEmployeeRequests($searchTerm);
    if ($result->num_rows > 0) {
                          
        while($row = $result->fetch_assoc()) {
          $dateToGetCovered = $row['workDay'];
          $timeStart = $row['requestTimeStart'];
          $timeEnd = $row['requestTimeEnd'];
          $shiftType = $row['shiftType'];
          $additionalDetails = $row['requestDetails'];
          $firstName = $row['firstName'];
          $lastName = $row['lastName'];
          $phone = $row['phone'];
          $employeeCoveringID = $row['employeeCoveringID'];

          if ($employeeCoveringID){
            $button = '<div class="d-flex-card-button" style="background-color: grey">Shift has been taken</div>';
          } else {
            $button = '<a href="#" class="d-flex-card-button">Cover Shift</a>';
          }
      
          if ($additionalDetails){
            $additionalDetailsText = '<p>Additional Details: '.$additionalDetails.'</p>';
          } else {
            $additionalDetailsText = '';
          }
         
          echo  '
          <li>
          <div class="flex-card">
            <div class="card-content">
              <h3>Shift Cover Opportunity</h3>
              <div class="text">
                <p>Shift Date: '.$dateToGetCovered.'</p>
                <p>Shift Times: '.$timeStart. " - " .$timeEnd.' </p>
                <p>Shift Type: '.$shiftType.'</p>
                '.$additionalDetailsText.'
              </div>
              <h3>Contact Information: </h3>
              <div class="text">
                <p>Cover shift for: '.$firstName. " " .$lastName.'</p>
                <p>Contact Info: '.$phone.'</p>
              </div>
              '.$button.'
            </div>
          </div>
        </li>
    
          ';

        }
      }
      
    

}



?>