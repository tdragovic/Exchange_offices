<?php 

		if(is_string($location)){

			$location_str = $location;

		}else{

			$location_str = implode(', ',$location);
		}
		
		$informations= sprintf("
			<div id='info' class='info border mx-auto mt-2 p-2' >
				<div class='row pl-2'>
					<div class='col-12 text-left h2 '>%s</div>
				</div>
				<div class='row  pr-4'>
					<div class='col-12 text-right'>
						<div class='h6'><i class='fa fa-map-marker' aria-hidden='true'></i> Lokacija</div>
						<div class=''>%s</div>
						<br>
						<div class=' h6'>Kontakt</div>
						<div id='contact_phone' class='m-1'><i class='fa fa-phone' aria-hidden='true'></i> %s</div>
						<div id='contact_email' class='m-1'><i class='fa fa-envelope' aria-hidden='true'></i> %s</div>
						<br>
					</div>
				</div>
				<div class='col-12 m-1 text-right pr-4'>
						<a href='index.php?page=profile&id=$get_id&action=edit_profile'><input type='button' id='edit_profile' class='btn btn-dark text-warning btn'  value='Izmeni'><a>
					</div>
				</div>",
				$name, $location_str, $phone, $email);
				
		echo $informations;	
		
?>