<?php
require_once '../includes/dbconnect.php';
$conn = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}
$conn->set_charset('UTF8');
$output = array();
$query = "SELECT id, name, img FROM health_practices WHERE 1 ORDER BY name ASC";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
}
?>