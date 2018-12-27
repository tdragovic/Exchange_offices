<?php  
	if(count($currency_label) == count($sell_rate)){
        echo "<div class='row'>
                
                <div class='col-6 mx-auto'>
                    <div class='justify-content-center h2 col-12 my-4'>Kursna lista</div>
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
								</tr>", $currency_label[$i], $sell_rate[$i], $buy_rate[$i], $diff[$i]);
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
                <div class='col-6'>
                    <div class='justify-content-center h4 col-12 my-4'>Kretanje EUR, 5 dana</div>
					<div id='chart_prof' class='row text-center'></div>
					<div class='row'></div>
					<div class='row'></div>
				</div>
				</div>
				";
			
	}	
?>