<?php 
	$stmt = $conn->prepare("SELECT * FROM exchange_office WHERE
		 	exchange_office_id=?");
			$stmt->bind_param('d',$exchange_office_id); 

			$stmt->execute();
			$result_select_info = $stmt->get_result();
	
			foreach ($result_select_info as $key => $value) {
				$name = $conn->real_escape_string($value['exchange_office_name']);
				$location = getLocation($exchange_office_id);
				$phone = $conn->real_escape_string($value['exchange_office_phone']);
				$email = $conn->real_escape_string($value['exchange_office_email']);
			}

			if($name==''){
				$name = "Naziv menjacnice";
			}
			if(count($location)==0){
				$location = "Lokacija menjacnice";
			}
			if($phone==''){
				$phone = "Kontakt menjacnice";
			}
			if($email==''){
				$email = "E-mail menjacnice";
			}

			$stmt = $conn->prepare("SELECT * FROM currency_list WHERE exchange_office_id=? ORDER BY currency_id");
			$stmt->bind_param('d',$exchange_office_id);
			$stmt->execute();
			$res = $stmt->get_result();
			$list = $res->num_rows;

			foreach ($res as $key => $value) {
				$currency_id = $conn->real_escape_string($value['currency_id']);
				$sell_rate[] = $conn->real_escape_string($value['sell_rate']);
				$buy_rate[] = $conn->real_escape_string($value['buy_rate']);
				$diff[] = $conn->real_escape_string($value['diff_24h']);
				$currency[] = getCurrencyInfo($currency_id);
			}
?>