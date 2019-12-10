<?php
    require_once('../dbFunctions.php');
    $db = new dbfunctions();
    $json = file_get_contents('php://input');
    $params = json_decode($json);
    $id = $_POST['id'];
    $db->deleteShiftById($id);
?>
