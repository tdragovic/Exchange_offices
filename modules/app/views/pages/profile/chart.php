<?php
    $metoda = $_POST['tip'] ?? false;
    
    if($metoda == 'grafik-line') {
    $exchange_office_id = 1002;
    $curr_id = 'EUR';
    $stmt = $conn->prepare("SELECT * FROM all_time_currency INNER JOIN exchange_office ON all_time_currency.exchange_office_name = exchange_office.exchange_office_name  WHERE exchange_office_id = ? AND currency_label = ?");
    $stmt->bind_param('ds', $exchange_office_id, $curr_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $final = array();
    if($result->num_rows > 0) {
        foreach ($result as $key => $row) {
            $final[] = array(
                'Menjacnica' => $row['exchange_office_name'],
                'Valuta' => $row['currency_label'],
                'Kupovni kurs' => $row['sell_rate'],
                'Srednji kurs' => $row['avg_rate'],
                'Prodajni kurs' => $row['buy_rate'],
                'datum' => $row['date'],
            );
        }
        echo json_encode($final);
    } else {
        return false;
    }

    }

?>

