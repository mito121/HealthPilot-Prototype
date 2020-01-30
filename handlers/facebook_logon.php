<?php

require_once '../includes/dbconnect.php';

$info = json_decode(file_get_contents("php://input"));

$output = array();

if (count($info) > 0) {

    $fb_id = mysqli_real_escape_string($dbConn, $info->id);
    $name = mysqli_real_escape_string($dbConn, $info->name);
    $email = mysqli_real_escape_string($dbConn, $info->email);
    $accessToken = $info->accessToken;

    $sql = "SELECT `id`, `fb_id`, `name`, `password`, `role_id`, `img`, `fb_id` "
            . " FROM `health_users`"
            . " WHERE email = '$email'";

    $result = $dbConn->query($sql);

    if ($result->num_rows > 0) { // If facebook user exists in database
        while ($obj = $result->fetch_object()) {// Check if user accouint is connected to facebook
            $user_id = $obj->id;
            $current_fb_id = $obj->fb_id;
        }

        if ($current_fb_id === null || empty($current_fb_id)) {
            $sql = "UPDATE `health_users` SET `fb_id`='$fb_id' WHERE id = '$user_id'";
            $dbConn->query($sql);
        }

        $sql = "SELECT `id`, `fb_id`, `name`, `email`, `password`, `role_id`, `img`, `fb_id` "
                . " FROM `health_users`"
                . " WHERE email = '$email'";

        $result = $dbConn->query($sql);

        while ($row = mysqli_fetch_array($result)) {
            $output[] = $row;
        }
    } else { // If facebook user doesn't exist
        //Generate random password
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $rndPass = array(); //remember to declare $rndPass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $rndPass[] = $alphabet[$n];
        }
        $randomPassword = password_hash(implode($rndPass), PASSWORD_DEFAULT);
        $sql = "INSERT INTO `health_users`(`name`, `email`, `password`, `role_id`, `fb_id`)
                VALUES ('$name', '$email', '$randomPassword',  '3', '$fb_id')";
        $result = $dbConn->query($sql);

        $sql = "SELECT `id`, `fb_id`, `name`, `email`, `role_id`, `img` "
                . " FROM `health_users`"
                . " WHERE fb_id = '$fb_id'";
        $result = $dbConn->query($sql);
        while ($row = mysqli_fetch_array($result)) {
            $output[] = $row;
        }
    }
    echo json_encode($output);
}