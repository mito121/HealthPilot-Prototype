<?php

require_once '../includes/dbconnect.php';

$dbConn->set_charset('UTF8');

$output = array();

$sql = "SELECT c.id AS comment_id, c.text AS comment_text, c.i_id AS comment_i_id, c.user_id AS comment_user_id, c.rate_time AS comment_rate_time, health_users.name AS user_name, health_users.img AS user_img FROM health_rating_text AS c INNER JOIN health_users ON health_users.id = c.user_id ORDER BY c.rate_time DESC";

$result = mysqli_query($dbConn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
}