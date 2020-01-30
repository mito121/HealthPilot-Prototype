<?php
require_once '../includes/dbconnect.php';
$info = json_decode(file_get_contents("php://input"));

if (count($info) > 0) {
    $id = mysqli_real_escape_string($dbConn, $info->id);

    $sql = "DELETE FROM health_users WHERE id='$id' ";
    $result = mysqli_query($dbConn, $sql);
		$output = "Bruger (ID " .$id. ") er slettet!";
} else {
		$output = "UPS, noget gik galt!";
}
echo($output);
?>

