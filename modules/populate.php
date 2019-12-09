<?php
/* Attempt MySQL server connection. Assuming you are running MySQL */
require_once('../dbFunctions.php');
 

$db = new dbfunctions();


if ($_POST['action'] == "updateDate"){
    // Escape user inputs for security
    $shiftID = $_POST['shiftID'];
    $datesHTML = '<h2>Day To Get Covered: </h2>
    <select name="date" class="largeInput">';
    $startDate = date('Y-m-d');
    $endDate = date('Y-m-d', strtotime("+3 months", strtotime($startDate)));


    //echo $shiftID;
    //datesHTML($shiftID);
    $result = $db->selectEmployeeShiftFromID($shiftID);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          $workDay = $row['workDay'];
          $timeStart = $row['timeStart'];
          $timeEnd = $row['timeEnd'];
          $employeeID = $row['employeeID'];
      }

      if ($workDay == "Monday"){
        $check = 1;
      } else if ($workDay == "Tuesday"){
        $check = 2;
      } else if ($workDay == "Wednesday") {
        $check = 3;
      } else if ($workDay == "Thursday") {
        $check = 4;
      } else if ($workDay == "Friday") {
        $check = 5;
      } else if ($workDay == "Saturday") {
        $check = 6;
      } else {
        $check = 7;
      }

      
      for ($i = strtotime($startDate); $i <= strtotime($endDate); $i = strtotime('+1 day', $i)) {
        if (date('N', $i) == $check) {
          $dateShow =  date('l Y-m-d', $i); //prints the date only if it's a Monday
          $dateValue = date('Y-m-d', $i);
          $datesHTML .= '<option value="'.$dateValue.'">'.$dateShow.'</option>';
        }
          
      }
      
    }
    $datesHTML .= '</select>';

    echo ($datesHTML);

    $timeHTML = '
    <input name="employeeID" value="'.$employeeID.'" style="display:none">
    <br><br>
    <h2>Start Time (24HR Time) (Only change if partial shift need to be covered): </h2>
    <fieldset>
        <input name="startTime" value="'.$timeStart.'">
    </fieldset>

    <br>
    <h2>End Time (24HR Time) (Only change if partial shift need to be covered): </h2>
    <fieldset>
        <input name="endTime" value="'.$timeEnd.'">
    </fieldset> ';
    
    echo ($timeHTML);

    $restHTML = '
    
    <br><br>
    <fieldset>
                    <textarea name="additionalInfo" placeholder="Additional information needed for shift..." tabindex="5"></textarea>
                  </fieldset>
                  <br>
                  <fieldset>
                    <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
                  </fieldset>
    ';

    echo ($restHTML);


  



} 

?>