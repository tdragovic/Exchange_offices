<?php
    include_once "../../../../db/connection.php";
    $metoda = $_POST['id'] ?? false;

    // if($metoda == 'grafik-line') {
        
		$exchange_office_id = $metoda;
		$curr_id = 'EUR';
        $stmt = $conn->prepare("SELECT * FROM all_time_currency INNER JOIN exchange_office ON all_time_currency.exchange_office_name = exchange_office.exchange_office_name  WHERE exchange_office.exchange_office_name = ? AND currency_label = ? AND date >= ( CURDATE() - INTERVAL 5 DAY) ");
        $stmt->bind_param('ss', $exchange_office_id, $curr_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $final = array();
        if($result->num_rows > 0) {
            foreach ($result as $key => $row) {
                $final [] = array(
                    // 'Menjacnica'    =>  $row['exchange_office_name'],
                    // 'Valuta'    =>	$row['currency_label'],
                    'Kupovni_kurs' =>   $row['sell_rate'],
                    'Srednji_kurs'	=>	$row['avg_rate'],
                    'Prodajni_kurs'	=>	$row['buy_rate'],
                    'datum'	=>	$row['date'],
                );
            }
			echo json_encode($final);
			exit();
        } else {
            return false;
        }
    // }

?>

