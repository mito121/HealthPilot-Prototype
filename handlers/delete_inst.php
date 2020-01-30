<?php
require_once '../includes/dbconnect.php';
$info = json_decode(file_get_contents("php://input"));

if (count($info) > 0) {
    $id = mysqli_real_escape_string($dbConn, $info->id);
  
    /* basic data */
    $sql = "DELETE FROM health_institutions WHERE id='$id'";
    $result = mysqli_query($dbConn, $sql);
  
    /* ratings */
    $sql = "DELETE FROM health_rating WHERE i_id='$id'";
    $result = mysqli_query($dbConn, $sql);

    /* rating text */
    $sql = "DELETE FROM health_rating_text WHERE i_id='$id'";
    $result = mysqli_query($dbConn, $sql);


      
      

    $output = "Behandleren er slettet!";
		echo $output;
  
		}
?>
