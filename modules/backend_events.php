<?php
    require_once('../dbFunctions.php');
    $db = new dbfunctions();
    $json = file_get_contents('php://input');
    $params = json_decode($json);
    $id = $params->id;
    $result = $db->selectEmployeeShiftsFromEmpoyeeID($id);
    $data = [];
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          $page = array();
          $startDate = date('Y-m-d');
          $endDate = date('Y-m-d', strtotime("+3 months", strtotime($startDate)));
          $workDay = $row['workDay'];
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
          $dateValue = "";
          for ($i = strtotime($startDate); $i <= strtotime($endDate); $i = strtotime('+1 day', $i)) {
            if (date('N', $i) == $check) {
                
                $dateValue = date('Y-m-d', $i);
                $timestart = $dateValue. 'T' . $row['timeStart'];
                $timeend = $dateValue. 'T' . $row['timeEnd'];
                $page['id'] = $row['scheduleID'];
                $page['start'] = $timestart;
                $page['end'] = $timeend;
                $page['text'] = $row['shiftType'];
                $data[] = $page;
            }
              
          }
          
      }
    }
    
    echo json_encode($data, JSON_PRETTY_PRINT);
    
    
?>
