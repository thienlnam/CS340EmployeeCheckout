<?php
    require_once('../dbFunctions.php');
    $db = new dbfunctions();
    $json = file_get_contents('php://input');
    $params = json_decode($json);
    $eid = $_POST['id'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $text = $_POST['name'];
    $parsed = explode("T", $start);
    $day = $parsed[0];
    $parsed2 = explode("T", $end);
    $page = array();
    $unixTime = strtotime($parsed[0]);
    $dayweek = date('l', $unixTime);
    $index = $db->insertIntoShifts($eid, $parsed[1], $parsed2[1], $text, $dayweek);
    $arr = array();
    $arr['id'] = $index;
    echo json_encode($arr, JSON_PRETTY_PRINT);
    
    
    
?>
