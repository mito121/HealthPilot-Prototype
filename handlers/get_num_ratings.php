<?php
require_once '../includes/dbconnect.php';
$output = array();
$info = json_decode(file_get_contents("php://input"));

if (count($info) > 0) {
    $id = mysqli_real_escape_string($dbConn, $info->id);
    $sql = "SELECT num_scores FROM inst_count_scores WHERE i_id='$id'";
    $result = mysqli_query($dbConn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output[] = $row;
        }
        echo json_encode($output);
    }
}
?>
