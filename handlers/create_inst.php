<?php
require_once '../includes/dbconnect.php';
$dbConn->set_charset('UTF8');
$info = json_decode(file_get_contents("php://input"));

if (count($info) > 0) {
    $name = mysqli_real_escape_string($dbConn, $info->name);
		$practice_id = mysqli_real_escape_string($dbConn, $info->practice_id);
		$street = mysqli_real_escape_string($dbConn, $info->street);
		$zip_id = mysqli_real_escape_string($dbConn, $info->zip_id);
		$tel = mysqli_real_escape_string($dbConn, $info->tel);
    $email = mysqli_real_escape_string($dbConn, $info->email);
		$web = mysqli_real_escape_string($dbConn, $info->web);
	  $owner_id = mysqli_real_escape_string($dbConn, $info->owner_id);
	
    $sql = "INSERT INTO health_institutions (name, practice_id, street, zip_id, tel, mail, web, owner_id) VALUES ('$name', '$practice_id', '$street', '$zip_id', '$tel', '$email', '$web', '$owner_id')";
    $result = mysqli_query($dbConn, $sql);
}

	if ($dbConn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;
			$output = "New record created successfully. Last inserted ID is: " . $last_id;
	} else {
			$output = "Error: " . $sql . "<br>" . $conn->error;
	}

$dbConn->close();
echo $output;
?>