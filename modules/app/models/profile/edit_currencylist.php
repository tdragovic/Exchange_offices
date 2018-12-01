<?php 
	if(isset($_POST['edit_currency'])){

			foreach($_POST as $key => $value) {

    			if (strpos($key, 'label') === 0) {
        			$label[] = $value;
    			}
    			if (strpos($key, 'sell_rate') === 0) {
        			$sell_rate[] = str_replace(",", ".", $value);
    			}
    			if (strpos($key, 'buy_rate') === 0) {
        			$buy_rate[] = str_replace(",", ".", $value);
    			}
    			
			}
			
			$sell = count($sell_rate);
			$buy = count($buy_rate);
			

			foreach($label as $key => $value){
				
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

			

			if($sell==$buy && count($errors)==0){
				foreach ($currencyid as $key => $value) {
					
					if($list>0){
						$stmt = $conn->prepare("UPDATE currency_list SET sell_rate=?,buy_rate=?, `date` = ? WHERE exchange_office_id=? AND currency_id=?");
						$stmt->bind_param('ddsdd',$sell_rate[$key],$buy_rate[$key], $date, $exchange_office_id,$value);
						$stmt->execute();

					}else{
						if(($sell_rate[$key]!='')&&($buy_rate[$key]!='')&&($sell_rate[$key]!='00.0000')&&($buy_rate[$key]!='00.0000')&&($sell_rate[$key]!=0)&&($buy_rate[$key]!=0)){

							$stmt = $conn->prepare("INSERT INTO currency_list(exchange_office_id, currency_id, sell_rate, buy_rate, `date`) VALUES (?, ?, ?, ?, $date)");
							$stmt->bind_param('dddd',$exchange_office_id,$value,$sell_rate[$key],$buy_rate[$key]);
							$stmt->execute();
							
						}
					}
					header("location:index.php?page=profile&id=$get_id");
				}
					
			}
		}
	
 ?>