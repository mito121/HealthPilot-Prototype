<?php
require_once '../includes/dbconnect.php';
$output = array();
$info = json_decode(file_get_contents("php://input"));

if (count($info) > 0) {
    $id = mysqli_real_escape_string($dbConn, $info->id);
//    $sql = "SELECT i.id, i.sundheddk_id AS i_sdkid, i.name AS i_name, i.zip_id AS i_zip, i.street AS i_street, i.tel AS i_tel, i.practice_id, i.mail AS i_mail, i.web AS i_web, i.owner_id AS i_owid, i.note AS i_note, i.up_date AS i_update, p.id AS p_id, p.name AS p_name, c.id AS c_id, c.zip_id, c.city AS c_name
//        FROM health_institutions AS i
//        LEFT JOIN health_practices AS p ON p.id = i.practice_id
//        LEFT JOIN health_cities AS c ON c.zip_id = i.zip_id
//		    LEFT JOIN health_rating_text AS s ON s.i_id = i.id
//        WHERE i.id='$id'";
    $sql = "SELECT i.id, i.name AS i_name, i.zip_id AS i_zip, i.street AS i_street, i.tel AS i_tel, i.practice_id, i.mail AS i_mail, i.web AS i_web, i.owner_id AS i_owid, lat, lng, p.id AS p_id, p.name AS p_name, c.id AS c_id, c.zip_id, c.city AS c_name
        FROM health_institutions AS i
        LEFT JOIN health_practices AS p ON p.id = i.practice_id
        LEFT JOIN health_cities AS c ON c.zip_id = i.zip_id
        LEFT JOIN health_rating_text AS s ON s.i_id = i.id
        WHERE i.id='$id'";
    $result = mysqli_query($dbConn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output[] = $row;
        }
        echo json_encode($output);
    }
}