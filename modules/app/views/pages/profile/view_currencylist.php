<?php  
	if(count($currency) == count($sell_rate)){
			echo "<form id='currency_form2' method='POST' action='form.php'>
					<table class='table table-striped table-bordered'>
						<thead>
							<tr>
								<th scope='col-1'>Valuta</th>
								<th scope='col-1'>Prodajni kurs</th>
								<th scope='col-1'>Kupovni kurs</th>
								<th scope='col-1'>Razlika</th>
							</tr>
						</thead>
						<tbody>";
						for($i = 0; $i < count($currency); $i++){
								$diff[$i] = $buy_rate[$i] - $sell_rate[$i];
								$currency_info = sprintf("
									<tr>
				   					<td><label id='name'>%s</label></td>
									<td>%s</td>
									<td>%s</td>
									<td>%s</td>
									</tr>", $currency[$i], $sell_rate[$i], $buy_rate[$i], $diff[$i]);
								echo $currency_info;
							
						}
						
						echo "</tbody>
						</table>
						</form>";
				
	}	
?>