<?php
require_once '../includes/dbconnect.php';
$conn = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}
$conn->set_charset('UTF8');
$output = array();
$query = "SELECT DISTINCT i.practice_id AS practice_id, p.id AS p_id, p.name AS p_name, p.img AS p_img 
            FROM health_institutions AS i
            INNER JOIN health_practices AS p ON i.practice_id = p.id
            ORDER BY p.name ASC";

$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
}