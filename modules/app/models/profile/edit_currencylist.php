<?php 
	if(isset($_POST['edit_currency'])){

			foreach($_POST as $key => $value) {

    			if (strpos($key, 'label') === 0) {
        			$label_post[] = $value;
    			}
    			if (strpos($key, 'sell_rate') === 0) {
        			$sell_rate_post[] = str_replace(",", ".", $value);
    			}
    			if (strpos($key, 'buy_rate') === 0) {
        			$buy_rate_post[] = str_replace(",", ".", $value);
    			}

    			
			}
			
			$sell = count($sell_rate_post);
			$buy = count($buy_rate_post);
			foreach($label_post as $key => $value){
				
				$stmt = $conn->prepare("SELECT currency_id FROM currency WHERE currency_label = ?");
				$stmt->bind_param('s',$value);

				$stmt->execute();
				$result_select_currency = $stmt->get_result();
		
				foreach ($result_select_currency as $key => $value){
					$currencyid[] = $value['currency_id'];
					
				}
			}

			$stmt = $conn->prepare("SELECT sell_rate FROM currency_list WHERE exchange_office_id = ?");
			$stmt->bind_param('d',$exchange_office_id);
			$stmt->execute();
			$result = $stmt->get_result();
			$list = $result->num_rows;

			if($sell==$buy){
				foreach ($currencyid as $key => $value) {
					
					if($list>0){
						$stmt = $conn->prepare("UPDATE currency_list SET sell_rate=?, buy_rate=?, `date` = ? WHERE exchange_office_id=? AND currency_id=?");
						$stmt->bind_param('ddsdd',$sell_rate_post[$key],$buy_rate_post[$key], $date, $exchange_office_id,$value);
						$stmt->execute();
						header("location:index.php?page=profile&id=$exchange_office_id");
					}else{
						if(($sell_rate_post[$key]!='')&&($buy_rate_post[$key]!='')&&($sell_rate_post[$key]!='00.0000')&&($buy_rate_post[$key]!='00.0000')&&($sell_rate_post[$key]!=0)&&($buy_rate_post[$key]!=0)){

							$stmt = $conn->prepare("INSERT INTO currency_list(exchange_office_id, currency_id, sell_rate, buy_rate, `date`) VALUES (?, ?, ?, ?, $date)");
							$stmt->bind_param('dddd',$exchange_office_id,$value,$sell_rate_post[$key],$buy_rate_post[$key]);
							$stmt->execute();
							header("location:index.php?page=profile&id=$exchange_office_id");
						}
					}
					
				}
					
			}
		} /*if(isset($_POST['save_xml']) && $_POST){

			$file = $_FILES['xml_input'];
			$xml = simplexml_load_file($file['tmp_name']);

			if($xml != '' && $file['type'] === 'text/xml'){
				
				$ex_name = $xml->ExchangeOffice;
				$date = $xml->Date;
				
				foreach ($xml->Currencies->Currency as $currency) {
					
					$sell = (string)($currency->sell);
					$buy = (string)($currency->buy);
					$middle = (string)($currency->middle);
					$currency_label = (string)($currency->label);
					$currency_name = (string)($currency->name);

					$new_curr = array($currency_label, $currency_name, $buy, $middle, $sell);
					$currencies[] = $new_curr;
				}
				
				sort($currencies);
				for($i = 0; $i < count($currencies); $i++) {
					$labels[] = $currencies[$i][0];
				}
				$stmt = $conn->prepare('SELECT * FROM currency_list INNER JOIN currency ON currency_list.currency_id = currency.currency_id WHERE exchange_office_id = ? ORDER BY currency_label');
				$stmt->bind_param('d', $exchange_office_id);
				$stmt->execute();
				$result = $stmt->get_result();

				foreach($result as $key => $row) {
					
					for($i = 0; $i < count($labels); $i++) {
						if($labels[$i] == $row['currency_label']) {
							// echo $labels[$i] . " " . $row['currency_label'] . "<br>";
							$curr_ids[] = $row['currency_id'];
						}
					}
				}
				
				foreach($labels as $key => $value) {
					if ($list > 0) {
						// echo $value . " " . $curr_ids[$key] . "<br>";

						$stmt = $conn->prepare("UPDATE currency_list SET sell_rate=?, avg_rate = ?, buy_rate=?, `date` = ? WHERE exchange_office_id=? AND currency_id=?");
						$stmt->bind_param('dddsdd', $currencies[$key][2], $currencies[$key][3], $currencies[$key][4], $date, $exchange_office_id, $curr_ids[$key]);
						$stmt->execute();
					} else {
						if(($sell_rate[$key]!='')&&($buy_rate[$key]!='')&&($sell_rate[$key]!='00.0000')&&($buy_rate[$key]!='00.0000')&&($sell_rate[$key]!=0)&&($buy_rate[$key]!=0)){
	
							$stmt = $conn->prepare("INSERT INTO currency_list(exchange_office_id, currency_id, sell_rate, buy_rate, `date`) VALUES (?, ?, ?, ?, $date)");
							$stmt->bind_param('dddd',$exchange_office_id,$value,$sell_rate[$key],$buy_rate[$key]);
							$stmt->execute();
							
						}
					}
				}
				
				
				
			}else{
				echo "<script>alert('Nevalidan XML fajl!')</script>";
			}
		}*/
	
 ?>