<?php
require_once '../includes/dbconnect.php';
$info = json_decode(file_get_contents("php://input"));

if (count($info) > 0) {
    $id = mysqli_real_escape_string($dbConn, $info->id);
    $new_name = mysqli_real_escape_string($dbConn, $info->new_name);
		$new_practice_id = mysqli_real_escape_string($dbConn, $info->new_practice_id);
		$new_street = mysqli_real_escape_string($dbConn, $info->new_street);
		$new_zip_id = mysqli_real_escape_string($dbConn, $info->new_zip_id);
		$new_tel = mysqli_real_escape_string($dbConn, $info->new_tel);
    $new_email = mysqli_real_escape_string($dbConn, $info->new_email);
		$new_web = mysqli_real_escape_string($dbConn, $info->new_web);
	  $new_owner_id = mysqli_real_escape_string($dbConn, $info->new_owner_id);

    $sql = "UPDATE health_institutions SET name='$new_name', practice_id='$new_practice_id', street='$new_street', zip_id='$new_zip_id', tel='$new_tel', mail='$new_email', web='$new_web', owner_id='$new_owner_id' WHERE id='$id' ";
    $result = mysqli_query($dbConn, $sql);
		}
?>

