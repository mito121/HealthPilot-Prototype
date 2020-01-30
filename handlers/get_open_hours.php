<?php
require_once '../includes/dbconnect.php';
$output = array();
$info = json_decode(file_get_contents("php://input"));

if (count($info) > 0) {
    $id = mysqli_real_escape_string($dbConn, $info->id);
    $sql = "SELECT health_institutions.id AS i_id, mon, tue, wed, thu, fri, sat, sun FROM health_institutions
	LEFT JOIN health_open ON health_open.sundheddk_id = health_institutions.sundheddk_id WHERE health_institutions.id='$id'";
    $result = mysqli_query($dbConn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output[] = $row;
        }
        echo json_encode($output);
    }
}
?>
