<?php
require_once '../includes/dbconnect.php';

$id = $dbConn->real_escape_string($_POST['id']);
$newName = $dbConn->real_escape_string($_POST['newName']);
$newPassword = $dbConn->real_escape_string($_POST['newPassword']);
$newPassword_hash = password_hash("$newPassword", PASSWORD_DEFAULT);
$newEmail = $dbConn->real_escape_string($_POST['newEmail']);

if (!empty($_FILES)) {
    // IMAGE UPLOAD  
    $valid_formats = array("jpg", "JPG", "JPEG", "PNG", "png", "gif", "bmp");
    $target_dir = "../uploads/";
    $filename = basename($_FILES["file"]["name"]);
    
    $orginal_target_path = "{$target_dir}$filename";
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($orginal_target_path)) {
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["file"]["size"] > 1000000) {
        $uploadOk = 0;
    }
    // Allow certain file formats
    if (!in_array(pathinfo($filename, PATHINFO_EXTENSION), $valid_formats)) {
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $output = "UPS, noget gik galt!";
    }
    // if everything is ok, try to upload file	
    else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $orginal_target_path)) {
            //DELETE OLD IMAGE AND INSERT NEW
            $sql = "SELECT  img FROM health_users WHERE id='$id'";
            $result = $dbConn->query($sql);
            if (mysqli_num_rows($result) > 0) {
                while ($obj = mysqli_fetch_object($result)) {
                    $old_img = $obj->img;
                }
                if (strlen($old_img) > 0) {
                    unlink($target_dir . $old_img);
                }
            }
            $img_url = basename($_FILES["file"]["name"]);

            //Check if new password is set
            if (empty($newPassword) || $newPassword === 'undefined') {
                $sql = " UPDATE health_users SET name='$newName', email='$newEmail', img='$img_url' WHERE id='$id' ";
                $output = "Dine nye oplysninger er gemt";
            } else {
                $sql = " UPDATE health_users SET name='$newName', email='$newEmail', password='$newPassword_hash', img='$img_url' WHERE id='$id' ";
                $output = "Dine nye oplysninger er gemt";
            }

            $result = $dbConn->query($sql);
//            $output = "Dine oplysninger er ændret.";
        } else {
            $output = "Noget gik galt.";
        }
    }
} else {
    //NO IMG
    //Check if new password is set
    if (empty($newPassword) || $newPassword === 'undefined') {
        $sql = " UPDATE health_users SET name='$newName', email='$newEmail' WHERE id='$id' ";
        $output = "Dine nye oplysninger er gemt (uden foto)";
    } else {
        $sql = " UPDATE health_users SET name='$newName', email='$newEmail', password='$newPassword_hash' WHERE id='$id' ";
        $output = "Dine nye oplysninger er gemt (uden foto)";
    }
    $result = $dbConn->query($sql);
}
echo $output;
?>