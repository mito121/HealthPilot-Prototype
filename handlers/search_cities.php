<?php

require_once '../includes/dbconnect.php';

$conn = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}
$conn->set_charset('UTF8');

$output = array();

$query = "SELECT DISTINCT i.zip_id, c.zip_id AS c_zip_id, c.city FROM health_institutions AS i 
            INNER JOIN health_cities AS c ON i.zip_id = c.zip_id
            ORDER BY c.city ASC";

$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
}