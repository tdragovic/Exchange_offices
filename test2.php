<?php
	include "./modules/db/connection.php";   
	$date = date('Y-m-d', time());

	$stmt = $conn->prepare('SELECT * FROM exchange_office_package');
	$stmt->execute();
	$result = $stmt->get_result();
	$current_income = 0;
	$total_income = 0;
	$last_month = 0;
	foreach ($result as $key => $row) {
		$id = $row['exchange_office_id'];
		$package_id = $row['package_id'];
		$end_date = $row['end_date'];
		$deactivation = 0;
		if($row['end_date'] < $date) {
			$stmt = $conn->prepare('UPDATE exchange_office SET activation = ? WHERE exchange_office_id = ?');
			$stmt->bind_param('dd', $deactivation, $id);
			$stmt->execute();
		} else {
			switch ($row['package_id']) {
				case '1':
					$current_income += 200;
					break;
				case '2':
					$current_income += 350;
					break;
				case '3':
					$current_income += 600;
					break;
				default:
					$err = 'Nesto je poslo naopako';
					break;
			}
		}
		switch ($row['package_id']) {
			case '1':
				$total_income += 200;
				break;
			case '2':
				$total_income += 350;
				break;
			case '3':
				$total_income += 600;
				break;
			default:
				$err = 'Nesto je poslo naopako';
				break;
		}
		if($row['start_date'] > date('Y-m-d', strtotime($date .' - 31 days'))) {
			switch ($row['package_id']) {
				case '1':
					$last_month += 200;
					break;
				case '2':
					$last_month += 350;
					break;
				case '3':
					$last_month += 600;
					break;
				default:
					$err = 'Nesto je poslo naopako';
					break;
			}
		}
	}
	$act = 1;
	$stmt = $conn->prepare('SELECT * FROM exchange_office_package INNER JOIN exchange_office ON exchange_office_package.exchange_office_id = exchange_office.exchange_office_id INNER JOIN package on exchange_office_package.package_id = package.package_id WHERE activation = ?');
	$stmt->bind_param('d', $act);
	$stmt->execute();
	$result = $stmt->get_result();

	foreach ($result as $key => $row) {
		
	}

	print('Trenutna zarada: ' . $current_income) . "<br>";
	print('Prošlomesečna zarada: ' . $last_month) . "<br>";
	print('Ukupna zarada: ' . $total_income) . "<br>";
?>