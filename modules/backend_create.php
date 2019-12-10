<?php
    require_once('../dbFunctions.php');
    $db = new dbfunctions();
    $json = file_get_contents('php://input');
    echo $json;
    $params = json_decode($json);
    $eid = $_POST['eid'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $text = $_POST['name'];
    $parsed = explode("T", $start);
    $day = $parsed[0];
    $parsed2 = explode("T", $end);
    
    $index = $db->insertIntoShifts($eid, $parsed[1], $parsed2[1], $text, $day);
    $arr = array();
    $arr['id'] = $index;
    return $arr;
    
    
    
?>
