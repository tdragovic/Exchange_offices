<?php

include "modules/db/connection.php";
    
include "functions/functions_api.php";

$stmt = $conn->prepare('SELECT exchange_office_location FROM exchange_office_location');
$stmt->execute();
$result = $stmt->get_result();
foreach($result as $key => $value) {
    insertCoordinates($api, $value['exchange_office_location'], $conn);
}

?>