<?php
require_once '../includes/dbconnect.php';
$dbConn->set_charset('UTF8');
$output = array();
$sql = "SELECT i_id, user_id, r_id, name, rating FROM health_rating LEFT JOIN health_rating_names ON health_rating_names.id = health_rating.r_id WHERE 1";
$result = mysqli_query($dbConn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
}