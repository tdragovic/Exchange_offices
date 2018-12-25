<?php 
	if(isset($_POST['save_profile'])) {
							$location = array();
							$name_office = trim($_POST['name_office']);
							$phone = '+381'. trim($_POST['phone0']);
							$email = trim($_POST['email0']);
		
							foreach($_POST as $key => $value) {
		    					if (strpos($key, 'location') === 0) {
		    		    			$location[] = trim($value);
		    		    		}
							}
		
							if(($name_office=='')||($phone=='')||($email=='')||(count($location)==0)){
		
								array_push($errors, "Sva polja moraju biti popunjena!");
		
							}
							if($name_office!=''){
									
								if(!checkExchangeName($name_office)){
									array_push($errors, "Naziv nije validan!");
								}
							}
							if(count($location)!=0){
								for($i=0;$i<count($location);$i++){
									
									if($location[$i]!=''){
		    		    				$n = $i+1;
		    		    				if(!checkLocation($location[$i])){
											array_push($errors, "Lokacija  $n nije validna!");
										}
												
		    		    			}
		    		    		}	
							}
							if($phone!=''){
		
								if(!checkPhone($phone)){
										
									array_push($errors, "Broj telefona nije validan!");
		
								}
							}	
							if($email!=''){
								if(!preg_match("/^([_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3}))$/", $email)){
											
									array_push($errors, "E-mail nije validan!");
					
								}
							}
			
			if(count($errors)==0){
			
				$stmt = $conn->prepare("UPDATE exchange_office SET exchange_office_name = ?, exchange_office_phone = ?, exchange_office_email = ? WHERE exchange_office_id = ? AND user_id = ?");
				$stmt->bind_param('sssdd', $name_office, $phone, $email, $exchange_office_id, $user_id);
				$stmt->execute();
			
				$locations = array();	
				$locations = getLocation($exchange_office_id);
				
				foreach($locations as $key => $value) {
					$stmt = $conn->prepare("DELETE exchange_office_location FROM exchange_office_location WHERE exchange_office_location = ?");
					$stmt->bind_param('s', $value);
					$stmt->execute();
				}
				foreach ($location as $key => $value) {
					$stmt = $conn->prepare("INSERT INTO exchange_office_location(exchange_office_id, exchange_office_location) VALUES (?, ?)");
					$stmt->bind_param('ds', $get_id, $value);
					$stmt->execute();
				}
				header("location: index.php?page=profile&id=$exchange_office_id");			

				
			}
		
	}
?>