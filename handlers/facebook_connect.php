<?php

require_once '../includes/dbconnect.php';

$info = json_decode(file_get_contents("php://input"));

$output = array();

if (count($info) > 0) {

    $fb_id = mysqli_real_escape_string($dbConn, $info->fb_id);
    $user_id = mysqli_real_escape_string($dbConn, $info->id);
    
    $sql = "UPDATE `health_users` SET `fb_id`='$fb_id' WHERE id = '$user_id'";
    $result = $dbConn->query($sql);
    
    if($result === true){
        echo "Din konto er nu forbundet med din facebook.";
    }else{
        echo "Der skete en fejl.";
    }
}