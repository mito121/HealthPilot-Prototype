<?php

require_once '../includes/dbconnect.php';

$output = array();

$sql = "SELECT i.id, i.name AS i_name, i.zip_id AS i_zip, i.street AS i_street, i.tel AS i_tel, i.practice_id, i.mail AS i_mail, i.web AS i_web, p.id AS p_id, p.name AS p_name, c.id AS c_id, c.zip_id, c.city AS c_name
        FROM health_institutions AS i
        INNER JOIN health_practices AS p ON p.id = i.practice_id
        INNER JOIN health_cities AS c ON c.zip_id = i.zip_id
        WHERE 1";

$result = mysqli_query($dbConn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
}