<?php
require_once '../includes/dbconnect.php';
$dbConn->set_charset('UTF8');
$output = array();

$sql = "SELECT o.op_name AS op_name, p.sunheddk_id, p.op_id, p.price_from, p.price_to, a.MinPriceFrom, a.MaxPriceTo, a.AvgPriceFrom, a.AvgPriceTo, a.DeltaFrom, a.DeltaTo
          FROM health_prices AS p 
          LEFT JOIN op_avg_prices AS a ON a.op_id = p.op_id 
          LEFT JOIN op_min_max_prices AS m ON m.op_id = p.op_id
          LEFT JOIN health_procedures AS o ON o.op_id = p.op_id 
          GROUP BY sunheddk_id, op_id";

$result = mysqli_query($dbConn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
}