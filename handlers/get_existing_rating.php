<?php
require_once '../includes/dbconnect.php';
$output = array();
$info = json_decode(file_get_contents("php://input"));

if (count($info) > 0) {
    $user_id = mysqli_real_escape_string($dbConn, $info->user_id);
    $inst_id = mysqli_real_escape_string($dbConn, $info->inst_id);
    $sql = "SELECT health_rating.user_id AS user_id,health_rating.i_id AS i_id,health_rating.r_id AS r_id,health_rating_names.name AS name,health_rating.rating AS rating
      FROM (health_rating left join health_rating_names on(health_rating_names.id = health_rating.r_id))
      WHERE health_rating.user_id = '$user_id' AND health_rating.i_id = '$inst_id'
      ORDER BY health_rating.user_id,health_rating.i_id,health_rating.r_id";
    $result = mysqli_query($dbConn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output[] = $row;
        }
        echo json_encode($output);
    }
}


