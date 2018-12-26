<?php 
	// $stmt = $conn->prepare("SELECT * FROM currency_list WHERE sell_rate != 0.0000 AND exchange_office_id = ?");
	// $stmt->bind_param('d', $exchange_office_id);
	// $stmt->execute();
	// $res = $stmt->get_result();
	// $currency = array();
	// foreach($res as $key => $value) {
	// 	$currency[] = $value['currency_id'];
	// }
	// print_r($currency);

	if(count($currency_label) == count($sell_rate)){
            echo "<div class='col-6 mx-auto'>
                    <div class='justify-content-center h2 my-4'>Kursna lista</div>
					<table class='table table-striped table-bordered'>
						<thead>
							<tr>
								<th scope='col-1'>Valuta</th>
								<th scope='col-1'>Kupovni kurs</th>
								<th scope='col-1'>Prodajni kurs</th>
								<th scope='col-1'>Razlika</th>
							</tr>
						</thead>
						<tbody>";
						$counter = 0;
						for($i = 0; $i < count($currency_label); $i++){
							$diff[$i] = abs($sell_rate[$i] - $buy_rate[$i]);
								
							if($sell_rate[$i] != 0) {
								$currency_info = sprintf("
									<tr>
				   					<td><label id='name'>%s</label></td>
									<td>%s</td>
									<td>%s</td>
									<td>%s</td>
									</tr>", $currency_label[$i], $buy_rate[$i], $sell_rate[$i], $diff[$i]);

								echo $currency_info;
							} else {
								$counter++;
							}
						} if($counter == 21) {
							echo "<tr><td colspan = '4' >Kursna lista je trenutno prazna</td></tr>";
						}
						
						echo "</tbody>
						</table>
						</div>
						<a href='index.php?page=profile&id=$get_id&action=edit_currencylist'><input type='button' id='currency_edit' class='btn-dark text-warning btn' name='edit_currency' value='Izmeni'>				
						</form>";
				
		}	
?>