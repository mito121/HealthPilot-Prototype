<?php
require_once '../includes/dbconnect.php';

$output = array();

$sql = "SELECT i.id AS i_id, i.name AS i_name, c.city AS c_name, p.id AS p_id, p.name AS p_name, CAST(AVG(s.rating) AS DECIMAL(10,1)) AS s_avg FROM ((health_institutions AS i LEFT JOIN health_practices AS p ON p.id = i.practice_id) LEFT JOIN health_cities AS c ON c.zip_id = i.zip_id) LEFT JOIN health_rating AS s ON s.i_id = i.id GROUP BY i.id ORDER BY s_avg DESC";

$result = mysqli_query($dbConn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
}