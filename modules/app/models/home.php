<?php
 $sql = "SELECT * FROM exchange_office LEFT JOIN currency_list on exchange_office.exchange_office_id = currency_list.exchange_office_id WHERE currency_id = '1'";
    $res = $conn->query($sql);
    foreach ($res as $key => $value) {
        $names[] = $value['exchange_office_name'];
        $ids[] = $value['exchange_office_id'];
        $currency_ids[] = $value['exchange_office_id'];
        $phones[] = $value['exchange_office_phone'];
        $emails[] = $value['exchange_office_email'];
    }
    
    
   
    $sql = "SELECT exchange_office_name, exchange_office_location, sell_rate FROM currency_list
    INNER JOIN exchange_office
    ON currency_list.exchange_office_id = exchange_office.exchange_office_id
    INNER JOIN exchange_office_location as loc
    ON loc.exchange_office_id = exchange_office.exchange_office_id
    WHERE sell_rate in (SELECT MAX(sell_rate) from currency_list WHERE currency_id = 1)
    GROUP BY exchange_office_name;";
    $res = $conn->query($sql);
?>