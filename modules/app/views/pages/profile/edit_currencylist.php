<?php
	include('./modules/app/models/profile/edit_currencylist.php');
?>
<body>
	<div id='main' class='container text-center justify-content-center mx-auto'>
		<div id='errors_currency'>
				<?php 
					if(isset($errors) && count($errors)!=0){
						foreach($errors as $key => $value){
							echo $errors[$key].'<br>';
							unset($errors[$key]);
						}
					}
		
				?>
		</div>
		<div id='xml_file_button' class='mt-5'>
			<form id='xml_file' action='index.php?page=profile&id=<?php echo $exchange_office_id;?>&action=edit_currencylist' method="post" enctype="multipart/form-data">
				<div class="file_choose mt-4">
					<label for="xml_input" id='xml_in' class="btn-dark text-warning btn">Učitaj XML</label>
					<input type="file" id='xml_input' name="xml_input" class='ml-6' style='display: none;'/>
				</div>
				<div class='file_button mt-4'>
					<div id='success_xml' class='m-3'>Fajl uspešno učitan <i class="fa fa-check" style='color:#ffc107;' aria-hidden="true"></i></div>
					<button type="submit" id="save_xml" class="btn-dark text-warning btn " name="save_xml">Upiši</button>
				</div>
			</form>
			<div id='show_desc' class='m-2'>Uputstvo!</div>
			<form id='description' method='GET' action='' class='col-8 border text-center justify-content-center mx-auto'>
				<p>XML fajl ucitaćete klikom na dugme "Učitaj XML". Ukoliko je fajl validan i u formatu koji
						odgovara našoj aplikaciji biće uspešno učitan. Nakon odabira fajla klikom na dugme "Upiši" 
						vaši podaci će automacki biti upisani u Kursnu listu ispod. Ukoliko ste sigurni da su podaci ispravni sačuvajte izmenu klikom na dugme "Sačuvaj", na dnu stranice. Primer formata koji naša aplikacija podržava preuzmite klikom na link<a href='index.php?page=profile&id=<?php echo $exchange_office_id;?>&action=edit_currencylist&file=Currency_list_example.xml' id='xml_link'> XML_Menjator</a></p>
			</form>
			
		</div>
		<div class='justify-content-center h2 m-5'>Kursna lista</div>
		<form id='currency_form1' method='POST' action='index.php?page=profile&id=<?php echo $exchange_office_id;?>&action=edit_currencylist'>
			<div class="col-8 mx-auto">
				<table class='table table-striped table-bordered m-4'>
					<thead>
						<tr>
							<th scope="col-3">Valuta</th>
							<th scope="col-3">Kupovni kurs</th>
							<th scope="col-3">Prodajni kurs</th>
							<th scope="col-3">Razlika 24h</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if(isset($_POST['save_xml']) && $_POST){

							$file = $_FILES['xml_input'];
							if($file['type'] === 'text/xml'){
								$xml = simplexml_load_file($file['tmp_name']);
								if($xml != '' && isset($xml->Currencies->Currency)){


								
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
									$sells[] = $currencies[$i][4];
									$buys[] = $currencies[$i][2];
								}
								$stmt = $conn->prepare('SELECT * FROM currency_list INNER JOIN currency ON currency_list.currency_id = currency.currency_id WHERE exchange_office_id = ? ORDER BY currency_label');
								$stmt->bind_param('d', $exchange_office_id);
								$stmt->execute();
								$result = $stmt->get_result();

								foreach($result as $key => $row) {
						
									for($i = 0; $i < count($labels); $i++) {
										if($labels[$i] == $row['currency_label']) {
											$curr_ids[] = $row['currency_id'];
										}
									}
								}
								foreach ($labels as $key => $value){
									
									if(($sells[$key]!='')&&($buys[$key]!='')){
										$d = (float)$sells[$key] - (float)$buys[$key];
										$t = sprintf("<tr>

											<td><label>%s</label><input type='hidden' name='label%d' value='%s'></td>
											<td><input class='form-control text-center' type='text' name='sell_rate%d' value='%s'></td>
											<td><input class='form-control text-center' type='text' name='buy_rate%d' value='%s'></td>
											<td><input class='form-control text-center' type='text' readonly value='%0.2f'></td>
											</tr>", $value, $key, $value,  $key, $sells[$key],  $key, $buys[$key],$d);
										echo $t;
									}
								}
								
								}else{
									echo "<tr><td colspan='4' class='text-center justify-content-center mx-auto'>Format xml-a nije validan! Pročitajte uputstvo!</td></tr>";
								}
							} else {
								echo "<tr><td colspan='4' class='text-center justify-content-center mx-auto'>Format xml-a nije validan! Pročitajte uputstvo!</td></tr>";
								exit();
							}
						}else{
							
							$stmt = $conn->prepare("SELECT * FROM currency_list WHERE exchange_office_id=?");
							$stmt->bind_param('d',$exchange_office_id);
							$stmt->execute();
							$res = $stmt->get_result();
							$list = $res->num_rows;
							
							foreach ($res as $key => $value) {
								$currency_id = $value['currency_id'];
								$sell_rate[] = $conn->real_escape_string($value['sell_rate']);
								$buy_rate[] = $conn->real_escape_string($value['buy_rate']);
								$diff[] = $conn->real_escape_string($value['diff_24h']);
								$label_view[] = getCurrencyInfo($currency_id);
								
							}

							if($list>0){
								
								foreach ($label_view as $key => $value){

									if(($sell_rate[$key]!='')&&($buy_rate[$key]!='')){
										$d = $sell_rate[$key] - $buy_rate[$key];
										$t = sprintf("<tr>

											<td><label>%s</label><input type='hidden' name='label%d' value='%s'></td>
											<td><input class='form-control text-center' type='text' name='sell_rate%d' value='%s'></td>
											<td><input class='form-control text-center' type='text' name='buy_rate%d' value='%s'></td>
											<td><input class='form-control text-center' type='text' readonly value='%s'></td>
											</tr>", $value, $key, $value,  $key, $sell_rate[$key],  $key, $buy_rate[$key],$d);
										echo $t;
									}
								}	
									$stmt = $conn->prepare("SELECT currency_label FROM currency");
									$stmt->execute();
									$labels = $stmt->get_result();
									
									foreach ($labels as $key => $value) {
										$currency_list[] = $conn->real_escape_string($value['currency_label']);
									}
									if(count($currency_list)!=count($label_view)){
										$currency_label = array_diff($currency_list,$label_view);
										foreach ($currency_label as $key => $value){
											
											$t = sprintf("<tr>
											<td><label>%s</label><input type='hidden' name='label%d' value='%s'></td>
											<td><input  class='form-control text-center' type='text' name='sell_rate%d' value='0'></td>
											<td><input  class='form-control text-center' type='text' name='buy_rate%d' value='0'></td>
											<td><input  class='form-control text-center' type='text' readonly placeholder='0'></td>
											</tr>", $value, $key, $value,  $key,  $key);
											echo $t;
										}
									}
									
										
								
								// }else{
								// 	$stmt = $conn->prepare("SELECT currency_label FROM currency");
								// 	$stmt->execute();
								// 	$labels = $stmt->get_result();
							
								// 	foreach ($labels as $key => $value) {
								// 		$currency_label[] = $conn->real_escape_string($value['currency_label']);
								// 	}
								// 	foreach ($currency_label as $key => $value){
										
								// 		$t = sprintf("<tr>
								// 			<td><label>%s</label><input type='hidden' name='label%d' value='%s'></td>
								// 			<td><input  class='form-control text-center' type='text' name='sell_rate%d' value='0'></td>
								// 			<td><input  class='form-control text-center' type='text' name='buy_rate%d' value='0'></td>
								// 			<td><input  class='form-control text-center' type='text' readonly placeholder='0'></td>
								// 			</tr>", $value, $key, $value,  $key,  $key);
								// 		echo $t;
											
								// 	}
								// }
							}
						}		
						?>
					</tbody>
				</table>
			</div>
			<button type="submit" id="currency_save" class="btn-dark text-warning btn" name="edit_currency">Sacuvaj</button>
		</form>
	</div>
