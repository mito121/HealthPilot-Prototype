<?php
require_once '../includes/dbconnect.php';

//$sql = "SELECT * FROM institutions_scores";

$sql = "SELECT i.id AS i_id, i.name AS i_name, i.zip_id AS i_zip, i.street AS i_street, i.lat AS lat, i.lng AS lng,
            i.tel AS i_tel, i.practice_id, i.mail AS i_mail, i.web AS i_web, p.id AS p_id,
            p.name AS p_name, c.id, c.zip_id, c.city AS c_name, CAST(AVG(s.rating) AS DECIMAL(10,1)) AS s_avg
            FROM ((health_institutions AS i
            LEFT JOIN health_practices AS p ON p.id = i.practice_id)
            LEFT JOIN health_cities AS c ON c.zip_id = i.zip_id)
            LEFT JOIN health_rating AS s ON s.i_id = i.id
            GROUP BY i.id, i.name, p.name, i.zip_id, c.city, i.street
            ORDER BY s_avg DESC";

//mysqli_query($dbConn, "SET SQL_BIG_SELECTS=1;");
$result = mysqli_query($dbConn, $sql);

//Output result
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
}