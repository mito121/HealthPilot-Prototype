<?php
require_once '../includes/dbconnect.php';

$info = json_decode(file_get_contents("php://input"));
if (count($info) > 0) {
    $u_id = mysqli_real_escape_string($dbConn, $info->u_id);
    $i_id = mysqli_real_escape_string($dbConn, $info->i_id);
    $rating1 = mysqli_real_escape_string($dbConn, $info->rating1);
    $rating2 = mysqli_real_escape_string($dbConn, $info->rating2);
    $rating3 = mysqli_real_escape_string($dbConn, $info->rating3);
    $rating4 = mysqli_real_escape_string($dbConn, $info->rating4);
    $rating5 = mysqli_real_escape_string($dbConn, $info->rating5);
    $rating_text = mysqli_real_escape_string($dbConn, $info->rating_text);

    $sql = "SELECT id, rating, r_id FROM health_rating WHERE user_id = '$u_id' AND i_id = '$i_id' AND r_id = '1'";
    $result = $dbConn->query($sql);
    if ($result->num_rows > 0) {
        $query = "UPDATE health_rating SET rating='$rating1' WHERE user_id='$u_id' AND i_id = '$i_id' AND r_id='1'";
        mysqli_query($dbConn, $query);
    } else {
        $query = "INSERT INTO health_rating (rating, i_id, r_id, user_id) VALUES ('$rating1', '$i_id', '1', '$u_id')";
        $result = mysqli_query($dbConn, $query);
    }

    $sql = "SELECT id, rating, r_id FROM health_rating WHERE user_id = '$u_id' AND i_id = '$i_id' AND r_id = '2'";
    $result = $dbConn->query($sql);
    if ($result->num_rows > 0) {
        $query = "UPDATE health_rating SET rating='$rating2' WHERE user_id='$u_id' AND i_id = '$i_id'  AND r_id= '2'";
        mysqli_query($dbConn, $query);
    } else {
        $query = "INSERT INTO health_rating (rating, i_id, r_id, user_id) VALUES ('$rating2', '$i_id', '2', '$u_id')";
        $result = mysqli_query($dbConn, $query);
    }

    $sql = "SELECT id, rating, r_id FROM health_rating WHERE user_id = '$u_id' AND i_id = '$i_id' AND r_id = '3'";
    $result = $dbConn->query($sql);
    if ($result->num_rows > 0) {
        $query = "UPDATE health_rating SET rating='$rating3' WHERE user_id='$u_id' AND i_id = '$i_id' AND r_id='3'";
        mysqli_query($dbConn, $query);
    } else {
        $query = "INSERT INTO health_rating (rating, i_id, r_id, user_id) VALUES ('$rating3', '$i_id', '3', '$u_id')";
        $result = mysqli_query($dbConn, $query);
    }

    $sql = "SELECT id, rating, r_id FROM health_rating WHERE user_id = '$u_id' AND i_id = '$i_id' AND r_id = '4'";
    $result = $dbConn->query($sql);
    if ($result->num_rows > 0) {
        $query = "UPDATE health_rating SET rating='$rating4' WHERE user_id='$u_id' AND i_id = '$i_id' AND r_id='4'";
        mysqli_query($dbConn, $query);
    } else {
        $query = "INSERT INTO health_rating (rating, i_id, r_id, user_id) VALUES ('$rating4', '$i_id', '4', '$u_id')";
        $result = mysqli_query($dbConn, $query);
    }

    $sql = "SELECT id, rating, r_id FROM health_rating WHERE user_id = '$u_id' AND i_id = '$i_id'  AND r_id='5'";
    $result = $dbConn->query($sql);
    if ($result->num_rows > 0) {
        $query = "UPDATE health_rating SET rating='$rating5' WHERE user_id='$u_id' AND i_id = '$i_id' AND r_id='5'";
        mysqli_query($dbConn, $query);
    } else {
        $query = "INSERT INTO health_rating (rating, i_id, r_id, user_id) VALUES ('$rating5', '$i_id', '5', '$u_id')";
        $result = mysqli_query($dbConn, $query);
    }

    $sql = "SELECT id, text FROM health_rating_text WHERE user_id = '$u_id' AND i_id = '$i_id'";
    $result = $dbConn->query($sql);
    if ($result->num_rows > 0) {
        if (strlen($rating_text) > 0) {
            $query = "UPDATE health_rating_text SET text='$rating_text' WHERE user_id='$u_id' AND i_id = '$i_id'";
            mysqli_query($dbConn, $query);
        }
    } else {
        if (strlen($rating_text) > 0) {
            $query = "INSERT INTO health_rating_text(text, i_id, user_id) VALUES ('$rating_text', '$i_id', '$u_id')";
            $result = mysqli_query($dbConn, $query);
        }
    }
}