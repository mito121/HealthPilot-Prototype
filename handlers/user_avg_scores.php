<?php
require_once '../includes/dbconnect.php';
$dbConn->set_charset('UTF8');
$output = array();
$sql = "select health_rating.user_id AS u_id, health_rating.i_id AS i_id, health_rating.r_id AS r_id, health_rating_names.name AS r_name,cast(avg(health_rating.rating) as decimal(10,1)) AS avg from (health_rating left join health_rating_names on (health_rating_names.id = health_rating.r_id)) group by health_rating.user_id, health_rating_names.name order by health_rating.user_id, health_rating.r_id";
$result = mysqli_query($dbConn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
}