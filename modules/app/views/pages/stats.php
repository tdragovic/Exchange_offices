<?php
	  
	$date = date('Y-m-d', time());
	$months = array('Januar', 'Februar', 'Mart', 'April', 'Maj', 'Jun', 'Jul', 'Avgust', 'Septembar', 'Oktobar', 'Novembar', 'Decembar');
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

	$stmt = $conn->prepare("SELECT count(package.package_id) as count FROM exchange_office_package INNER JOIN exchange_office ON exchange_office_package.exchange_office_id = exchange_office.exchange_office_id INNER JOIN package ON exchange_office_package.package_id = package.package_id WHERE activation = ? GROUP BY package.package_id");
	$stmt->bind_param('d', $act);
	$stmt->execute();
	$result = $stmt->get_result();

	foreach ($result as $key => $row) {
		echo "Kupljenih paketa " . ($key+1) . " : " . $row['count'] . "<br>";
	}

	$stmt = $conn->prepare("SELECT exchange_office_package.start_date, avg(package_price) as avg, sum(package_price) as sum, min(package_price) as min, max(package_price) as max, count(exchange_office_package.package_id) as count FROM exchange_office_package INNER JOIN exchange_office ON exchange_office_package.exchange_office_id = exchange_office.exchange_office_id INNER JOIN package on exchange_office_package.package_id = package.package_id WHERE activation = ? GROUP BY MONTH(start_date)");
	$stmt->bind_param('d', $act);
	$stmt->execute();
	$result = $stmt->get_result();

	foreach ($result as $key => $row) {
		// $dates[] = $row['start_date'];
		$month = substr($row['start_date'], strpos($row['start_date'], '-')+1, 2);
		$dates[] = $months[$month-1];
		$averages[] = (float)($row['avg']);
		$sums[] = $row['sum'];
		$maximums[] = $row['max'];
		$tr = array($months[$month-1], $row['avg'], $row['sum'], $row['min'], $row['max']);
		$trs[] = $tr;
	}

	foreach($trs as $key => $col) {
		$col = sprintf("<tr>
		<td>%s</td>
		<td>%0.2f</td>
		<td>%s</td>
		<td>%s</td>
		<td>%s</td>
		</tr>", $col[0], $col[1], $col[2], $col[3], $col[4]);
		$cols[] = $col;
	}
	
	$table = sprintf("<table class='table table-striped'>
		<th>Month</th>
		<th>Average</th>
		<th>Sum</th>
		<th>Min</th>
		<th>Max</th>
		%s%s%s
	</table>", $cols[0], $cols[1], $cols[2]);

	echo $table;

	print('Trenutna zarada: ' . $current_income) . "<br>";
	print('Prošlomesečna zarada: ' . $last_month) . "<br>";
	print('Ukupna zarada: ' . $total_income) . "<br>";
?>
