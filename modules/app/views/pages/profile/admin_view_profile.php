<?php 

		if(is_string($location)){

			$location_str = $location;

		}else{

			$location_str = implode(', ',$location);
		}
        $phone = str_replace(" ", "&nbsp", $phone);
        
		$informations= sprintf("
			
        <div id='profile_lat'></div>
        <div id='profile_lng'></div>
        
		
        <div id='info' class='info mx-auto mt-3' >
            <div class='row mx-auto'>
                <div class='col-12'>
                    <div id='map' class='row mx-auto h-100 card' style='min-height:60vh;'></div>
                </div>
                <div class='col-12 align-middle'>
                <table class='table border table-borderless text-center'>
                <thead>
                    <tr>
                        <th rowspan='3' id='eo_name' class='eo_name align-bottom border-right'>%s</th>
                        <th rowspan='2' class='align-middle border'><i class='fa fa-map-marker mr-2 ' aria-hidden='true'></i> Lokacija</th>
                        <th colspan='2' class='align-middle border'>Kontakt</th>
                    </tr>
                    <tr>
                        <th class='align-middle border'><i class='fa fa-phone my-auto' aria-hidden='true'></i></td>
                        <th class='align-middle border'><i class='fa fa-envelope my-auto' aria-hidden='true'></i><span class='my-auto ml-2'></td>    
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class='align-middle border-right'></td>
                        <td class='align-middle border'>%s</td>
                        <td class='align-middle border'>%s</td>
                        <td class='align-middle border'>%s</td>
                    </tr>
                </tbody>
            </table>
            </div>
            </div>
            <div class='row mx-auto'>
                <div class='col-1 ml-auto' style='margin-right: .8rem';>
                    <a href='index.php?page=profile&id=$exchange_office_id&action=edit_profile'><input type='button' id='edit_profile' class='btn btn-dark text-warning btn'  value='Izmeni'><a>
                </div>
            </div>
        </div>
        ",
				$name, $location_str, $phone, $email);
				
		echo $informations;	
		
?>