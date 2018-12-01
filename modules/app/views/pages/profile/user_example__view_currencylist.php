<?php
	echo "<form  id='currency_form3'>
		<table class='table table-striped'>
			<thead>
				<tr>
					<th scope=col-3'>Valuta</th>
					<th scope='col-3'>Prodajni kurs</th>
					<th scope='col-3'>Kupovni kurs</th>
					<th scope='col-3'>Razlika 24h</th>
				</tr>
			</thead>
			<tbody>";
				$stmt = $conn->prepare("SELECT currency_label FROM currency");
				$stmt->execute();
				$labels = $stmt->get_result();
				
					foreach ($labels as $key => $value) {
						$currency_label[] = $conn->real_escape_string($value['currency_label']);
						
					}
					foreach ($currency_label as $key => $value){
						
							$t = sprintf("<tr>
								<td><label>%s</label><input type='hidden' name='name%d' value='%s'></td>
								<td><input type='number' readonly placeholder='00.0000'></td>
								<td><input type='number' readonly placeholder='00.0000'></td>
								<td><input type='number' readonly placeholder='00.00'></td>
								</tr>", $value, $key, $value);
							echo $t;
					}
		echo "</tbody>
			</table><a href='index.php?page=currencylist_edit&id=$get_id'><input type='button' id='currency_edit3' class='btn-dark text-warning btn' name='edit_currency' value='Izmeni'></a>
		</form>";				
?>