<?php

include "modules/db/connection.php";
    
include "functions/functions_api.php";

$lat = '44.8175329';
$lng = '20.4179972';

$api = 'AIzaSyBJBn7elZA5meKmAECWwDy3jT9480ULzB4';
$start = "$lat,$lng";
$destinations = ''; # '44.8175329,20.4179972';

$stmt = $conn->prepare('SELECT *, 6371 * 2 * ASIN(SQRT( POWER(SIN((? - exchange_office_lat) *  pi()/180 / 2), 2) +COS(? * pi()/180)
* COS(exchange_office_lat * pi()/180) * POWER(SIN((? - exchange_office_lng) * pi()/180 / 2), 2) )) AS distance FROM exchange_office_location ORDER BY distance LIMIT 0,5');
$stmt->bind_param('sss', $lat, $lat, $lng);
$stmt->execute();
$results = $stmt->get_result();

# PRAVIMO $destinations za api_url

foreach ($results as $key => $result) {
    $lat = $result['exchange_office_lat'];
    $lng = $result['exchange_office_lng'];
    if($key == 0) {
        $destinations = $lat . ',' . $lng;
    } else {
        $destinations .= "|" . $lat . ',' . $lng;
    }
}

print_r($destinations);

?>