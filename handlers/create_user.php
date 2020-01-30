<?php
require_once '../includes/dbconnect.php';
$dbConn->set_charset('UTF8');
$info = json_decode(file_get_contents("php://input"));

if (count($info) > 0) {
    $name = mysqli_real_escape_string($dbConn, $info->name);
    $email = mysqli_real_escape_string($dbConn, $info->email);
    $password = mysqli_real_escape_string($dbConn, $info->password);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO health_users (name, email, password) VALUES ('$name', '$email', '$password_hash')";
    $result = mysqli_query($dbConn, $sql);

    if ($result == true) {
        $new_id = $dbConn->insert_id;
    } 
  $dbConn->close();
}
echo($new_id);
?>