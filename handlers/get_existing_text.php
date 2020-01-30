<?php
require_once '../includes/dbconnect.php';
$output = array();
$info = json_decode(file_get_contents("php://input"));

if (count($info) > 0) {
    $user_id = mysqli_real_escape_string($dbConn, $info->user_id);
    $inst_id = mysqli_real_escape_string($dbConn, $info->inst_id);
    
    $sql = "SELECT text FROM health_rating_text WHERE i_id='$inst_id' AND user_id='$user_id'";
    $result = mysqli_query($dbConn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output[] = $row;
        }
        echo json_encode($output);
    }
}
?>