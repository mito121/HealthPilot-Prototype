<?php

require_once '../includes/dbconnect.php';
require_once 'geocoding.php';

use myPHPnotes \Geocoding;

$geo = new Geocoding("AIzaSyD8BQ6BjptxY6rXPxY5cdY7f4ZahsUCN7w"); // API key
//$sql = "SELECT * FROM institutions_scores";

$sql = "SELECT `id`, `zip_id`, `street`, `lat`, `lng` FROM `health_institutions` ORDER BY id DESC";

$result = mysqli_query($dbConn, $sql);

$newgeo = 0;

if ($result->num_rows > 0) {

    while ($row = mysqli_fetch_array($result)) {
        $institutions[] = $row;
    }
    
    $size = count($institutions);
    
    $i = 0;
    
    while ($i < $size) {
        
        $id = $institutions[$i]['id'];
        $address = $institutions[$i]['zip_id'] . ', ' . $institutions[$i]['street'] . ', DK';
        $lat = $institutions[$i]['lat'];
        $lng = $institutions[$i]['lng'];

        if ($lat === null || $lat === 0 || $lat === "0" || $lng === null || $lng === 0 || $lng === "0") {
            $newgeo++;
            $coordinates = $geo->getCoordinates($address);
            $lat = floatval($coordinates['latitude']);
            $lng = floatval($coordinates['longitude']);

            $sql = "UPDATE `health_institutions` SET `lat`='$lat',`lng`='$lng' WHERE id='$id';";
            $result = mysqli_query($dbConn, $sql);
            $output = "$newgeo institution(er) blev geocoded.";
        }
        
        $i++;
    }
}
if($newgeo === 0){
    $output = "Alle institutioner er geocoded.";
}
echo $output;
