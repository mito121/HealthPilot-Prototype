<?php

require_once '../includes/dbconnect.php';
$conn = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}
$conn->set_charset('UTF8');
$output = array();
//$query = "SELECT * FROM inst_avg_scores";
$query = "SELECT health_rating.i_id AS i_id, health_rating.r_id AS r_id,health_rating_names.name AS r_name,cast(avg(health_rating.rating) as decimal(10,1)) AS avg
            FROM (health_rating
            left join health_rating_names on(health_rating_names.id = health_rating.r_id))
            GROUP BY health_rating.i_id,health_rating_names.name
            ORDER BY health_rating.i_id,health_rating.r_id";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
}