<?php
    include '../modules/db/connection.php';

    $sql = "SELECT eo.exchange_office_name, c.currency_label, sell_rate, avg_rate, buy_rate, date  FROM currency_list cl INNER JOIN exchange_office eo ON cl.exchange_office_id = eo.exchange_office_id INNER JOIN currency c ON cl.currency_id = c.currency_id ORDER BY cl.exchange_office_id, c.currency_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $values = "";

    foreach ($result as $key => $row) {
        $eo_name = $row['exchange_office_name'];
        $cl = $row['currency_label'];
        $sell = $row['sell_rate'];
        $avg = $row['avg_rate'];
        $buy_rate = $row['buy_rate'];
        $date = $row['date'];
        
        $value = "('$eo_name', '$cl', '$sell', '$avg', '$buy_rate', '$date')";

        // $sql = "INSERT INTO all_time_currency (exchange_office_name, currency_label, sell_rate, avg_rate, buy_rate, date) VALUES $value";
        // $conn->query($sql);

        $sql = "INSERT INTO all_time_currency (exchange_office_name, currency_label, sell_rate, avg_rate, buy_rate, date) VALUES $value";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if($key == 0) {
            $values = $value;
        } else {
            $values .= ', ' . $value;
        }
        #$value = array($eo_name, $cl, $sell, $avg, $buy_rate, $date);
    }
    // print($values);
    // $sql = "INSERT INTO all_time_currency (exchange_office_name, currency_label, sell_rate, avg_rate, buy_rate, date) VALUES $values";
    // $stmt = $conn->prepare($sql);
    // $stmt->execute();
?>