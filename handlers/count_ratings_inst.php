<?php
require_once '../includes/dbconnect.php';
$output = array();
$info = json_decode(file_get_contents("php://input"));

$inst_id = mysqli_real_escape_string($dbConn, $info->inst_id);

$sql = "SELECT COUNT(user_id) AS antal FROM health_rating_text WHERE i_id='$inst_id' GROUP BY i_id";
$result = mysqli_query($dbConn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
}
?>