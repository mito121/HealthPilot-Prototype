<?php
require_once '../includes/dbconnect.php';
$conn = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}
$conn->set_charset('UTF8');
$output = array();

$query = "SELECT s.i_id AS i_id, s.user_id AS u_id, i.name AS i_name, p.name AS p_name, c.city AS c_name, cast(avg(s.rating) as decimal(10,1)) AS s_avg FROM health_rating as s LEFT JOIN health_institutions AS i ON i.id = s.i_id LEFT JOIN health_practices AS p ON p.id = i.practice_id LEFT JOIN health_cities AS c ON c.zip_id = i.zip_id GROUP BY i_id, u_id";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
}