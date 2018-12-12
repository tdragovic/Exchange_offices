<?php

    $api = "AIzaSyBJBn7elZA5meKmAECWwDy3jT9480ULzB4";

    function insertCoordinates(&$api, $addr, &$conn) {
        $addr_changed = str_replace(' ', '+', $addr);
        $file = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=$addr_changed&key=$api");
        $json = json_decode($file);
        
        $lat = ($json->results[0]->geometry->location->lat);
        $lng = ($json->results[0]->geometry->location->lng);

        $stmt = $conn->prepare("UPDATE exchange_office_location SET exchange_office_lat = ?, exchange_office_lng = ? WHERE exchange_office_location = ?");
        $stmt->bind_param('dds', $lat, $lng, $addr);
        $stmt->execute();   
    }

    function calcDrivingMulti($origins, $destinations, $api, &$conn) {
        $file = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origins&destinations=$destinations&key=$api");
        $json = json_decode($file);

        $elements = $json->rows[0]->elements;

        foreach($elements as $key => $value) {
            $dest = $json->destination_addresses[$key];
            $d = substr($dest, 0, strpos($dest, ','));
            $dist = $value->distance->text;
            $time = $value->duration->text;
            $distance[] = array($d, $dist, $time);
        }
        return $distance;
    }
    function calcWalkingMulti($origins, $destinations, $api, &$conn) {
        $file = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origins&destinations=$destinations&key=$api&mode=walking");
        $json = json_decode($file);

        $elements = $json->rows[0]->elements;

        foreach($elements as $key => $value) {
            $dest = $json->destination_addresses[$key];
            $d = substr($dest, 0, strpos($dest, ','));
            $dist = $value->distance->text;
            $time = $value->duration->text;
            $distance[] = array($d, $dist, $time);
        }
        return $distance;
    }

    function getClosestDb($lat, $lng, &$conn) {
        $nearby = array();
        $stmt = $conn->prepare("SELECT location_id, exchange_office_location.exchange_office_id, exchange_office_name, exchange_office_location, exchange_office_lat, exchange_office_lng, 6371 * 2 * ASIN(SQRT( POWER(SIN((? - exchange_office_lat) *  pi()/180 / 2), 2) +COS(? * pi()/180)
        * COS(exchange_office_lat * pi()/180) * POWER(SIN((? - exchange_office_lng) * pi()/180 / 2), 2) )) AS distance
       FROM exchange_office_location
       INNER JOIN exchange_office
       ON exchange_office_location.exchange_office_id = exchange_office.exchange_office_id
       ORDER BY distance
       LIMIT 0,5");
        $stmt->bind_param('sss', $lat, $lat, $lng);
        $stmt->execute();
        $results = $stmt->get_result();
        foreach ($results as $key => $result) {
            $location_id = $result['location_id'];
            $exchange_office_ids = $result['exchange_office_id'];
            $exchange_office_name = $result['exchange_office_name'];
            $exchange_office_location = $result['exchange_office_location'];

            $location = array($location_id, $exchange_office_ids, $exchange_office_name, $exchange_office_location);
            $locations[] = $location;
        }
        return $locations;
    }
?>