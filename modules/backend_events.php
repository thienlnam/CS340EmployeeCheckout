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
          $timestart = $row['workDay']. 'T' . $row['timeStart'];
          $timeend = $row['workDay']. 'T' . $row['timeEnd'];
          $page['id'] = $row['scheduleID'];
          $page['start'] = $timestart;
          $page['end'] = $timeend;
          $page['text'] = $row['shiftType'];
          $data[] = $page;
      }
    }
    
    echo json_encode($data, JSON_PRETTY_PRINT);
    
    
?>
