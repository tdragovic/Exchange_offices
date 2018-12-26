<?php
    include_once "../../db/connection.php";

    $eo_name = 'Erste bank';
        
    $stmt = $conn->prepare('SELECT exchange_office_lat AS lat, exchange_office_lng AS lng, 6371 * 2 * ASIN(SQRT( POWER(SIN((? - exchange_office_lat) *  pi()/180 / 2), 2) +COS(? * pi()/180)
    * COS(exchange_office_lat * pi()/180) * POWER(SIN((? - exchange_office_lng) * pi()/180 / 2), 2) )) AS distance 
    FROM exchange_office_location INNER JOIN exchange_office ON exchange_office_location.exchange_office_id = exchange_office.exchange_office_id WHERE exchange_office.exchange_office_name = ? ORDER BY distance');
    $stmt->bind_param('ssss', $lat, $lat, $lng, $eo_name);
    $stmt->execute();
    $results = $stmt->get_result();
    $response = array();
    foreach ($results as $key => $row) {
        // $lat = $row['lat'];
        // $lng = $row['lng'];
        $response[] = array(
            'lat' =>   $row['lat'],
            'lng'	=>	$row['lng'],
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
?>