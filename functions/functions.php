<?php 
	function screen_print($screen_print, $map){
		if(!is_array($map)){
            return $screen_print;
        }else{
			foreach($map AS $k => $v)
				$screen_print = str_replace("{{{$k}}}", $v, $screen_print);
			return $screen_print;
		}
	}
	function screen_print_nav_bar($user,$username){
		global $exchange_office_name, $id;
		switch($user){
			case'user':
				$map_user = array('OFFICE_NAME' => $exchange_office_name, 'SESSION_ID' => $id );
				$nav_bar_user = file_get_contents("./modules/app/views/inc/nav_bar_user.html");
				return screen_print($nav_bar_user, $map_user);
			break;
			case'admin':
				$nav_bar_admin = file_get_contents("./modules/app/views/inc/nav_bar_admin.html");
				$map_admin = array('USERNAME' => $username);
				return screen_print($nav_bar_admin, $map_admin);
			break;
			case'anonymous':
				$nav_bar = file_get_contents("./modules/app/views/inc/nav_bar.html");
				$map = '';
				return screen_print($nav_bar, $map);
			break;
		}
	}
	function getPassword($exchange_office_name) {
        global $conn;
        $stmt = $conn->prepare("SELECT password FROM user LEFT JOIN exchange_office ex ON user.user_id = ex.user_id WHERE exchange_office_name = ?");
        $stmt->bind_param('s', $exchange_office_name);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            return $row['password'];
        }
    }
	function checkProfile($id){
		global $conn;
		$stmt = $conn->prepare("SELECT * FROM exchange_office WHERE exchange_office_id=?");	
		$stmt->bind_param('d',$id);
		$stmt->execute();
		$res = $stmt->get_result();
		if($res->num_rows == 1) {
			return true;
		} else {
			return false;
		}
	}
	function sessionCheckUser($user,$id){
		global $conn;
		$stmt = $conn->prepare("SELECT exchange_office_id FROM exchange_office WHERE user_id=(SELECT user_id FROM user WHERE username=?)");	
		$stmt->bind_param('s',$user);
		$stmt->execute();
		$res = $stmt->get_result();
		$row = $res->fetch_assoc();
		$office_id = $conn->real_escape_string($row['exchange_office_id']);
		
		if($office_id==$id) {
			return true;
		}else{
			return false;
		}
		
	}

	function checkUsername($username) {
		if(!preg_match('/^[A-Za-z0-9]+(?:[_-][A-Za-z0-9]+)*$/', $username)) {
			return false;
		}
		return true;
	}
	function checkExchangeName($exchange_office_name) {
		if(!preg_match("/^[A-z ,.'-]+$/", $exchange_office_name)) {
			return false;
		}
		return true;
	}
	function checkLocation($location) {
		if(!preg_match('/^[A-z]+[ ,]*[0-9 A-z]+$/', $location)) {
			return false;
		}
		return true;
	}
	function checkPhone($phone) {
		if(!preg_match('/^([+]381( |\-)*[0-9]{2,}[( |\-)*[0-9]{3,}]*)$/', $phone)) {
			return false;
		}
		return true;
	}
	function checkPib($pib) {
		if(ctype_alpha($pib) || strlen($pib) != 9) {
			return false;
		}
		return true;
	}
	function checkJmb($jmb) {
		if(ctype_alpha($jmb) || strlen($jmb) != 8) {
			return false;
		}
		return true;
	}
	function getLocation($id){
		
		global $conn;

		$stmt = $conn->prepare("SELECT * FROM exchange_office_location WHERE exchange_office_id = ?");
		$stmt->bind_param('d',$id);
		$stmt->execute();
		$result_select_location = $stmt->get_result();
		$rows = $result_select_location->num_rows;
		
		if($rows == 0){
			$exchange_office_location = array();
		}
		foreach ($result_select_location as $key => $value) {
			$exchange_office_location[] = $conn->real_escape_string($value['exchange_office_location']);
		}
		

		return $exchange_office_location;
		
	}
	function getLocations($id) {
        global $conn;
        $sql = "SELECT exchange_office_location FROM exchange_office_location WHERE exchange_office_id = '$id'";
        $res = $conn->query($sql);
        foreach($res as $key => $value) {
            $locations[] = $value['exchange_office_location'];
        }
        if(isset($locations)) {
            return $locations;
        }
    }
   
	function getRate($exchange_office_id, $rate) {
        global $conn;

        $sql = "SELECT sell_rate, avg_rate, buy_rate FROM currency_list WHERE exchange_office_id = '$exchange_office_id' AND currency_id = '1'";
        $res = $conn->query($sql);
        foreach($res as $key => $value) {
            if(isset($value['sell_rate']) && isset($value['avg_rate']) && isset($value['buy_rate'])) {
                $sell_rate = $value['sell_rate'];            
                $avg_rate = $value['avg_rate'];
                $buy_rate = $value['buy_rate'];
            }
        }
        if($rate == "sell") {
            return $sell_rate;
        } elseif ($rate == "avg") {
            return $avg_rate;
        }
        return $buy_rate;
    }

	function getCurrencyInfo($currency_id){
		
		global $conn;

		$stmt = $conn->prepare("SELECT * FROM currency WHERE currency_id = ?");
		$stmt->bind_param('d',$currency_id);

		$stmt->execute();
		$result_select_currency = $stmt->get_result();
		
		foreach ($result_select_currency as $key => $value){
			$currency_name = $conn->real_escape_string($value['currency_name']);
			$currency_label = $conn->real_escape_string($value['currency_label']);
			
		}
		return $currency_label ;
	}
	
	function updateLocation(&$locations_new, &$locations_old) {
		$count_new = count($locations_new);
		$count_old = count($locations_old);

		if($count_new == $count_old) {
			foreach ($locations_old as $key => $value) {
				$locations_old[$key] = $locations_new[$key];
			}
		} elseif ($count_new > $count_old) {
			foreach ($locations_old as $key => $value) {
				$locations_old[$key] = $locations_new;
			}
			for($i = $count_old; $i < $count_new; $i++) {
				$locations_old[] = $locations_new[$i];
			}
		} else {
			foreach ($locations_new as $key => $value) {
				$locations_old[$key] = $locations_new[$key];
			}
			for($i = $count_new; $i < $count_old; $i++) {
				unset($count_old[$i]);
			}
		}
		return $locations_old;
	}

	/* NOVE FUNKCIJE */
	function checkCreationForm() {
		if(isset($_POST['save_profile'])) {

			$errors = array();

			$name_office = trim($_POST['exchange_office_name']);
			$phone = '+381'. trim($_POST['exchange_office_phone']);
			$email = trim($_POST['exchange_office_email']);
			$pib = trim($_POST['exchange_office_pib']);
			$jmb = trim($_POST['exchange_office_jmb']);

			foreach($_POST as $key => $value) {
    			if (strpos($key, 'location') === 0) {
        			$location[] = trim($value);
        		}
			}

			if(($name_office=='')||($phone=='')||($email=='')||(count($location)==0) || ($pib == "") || ($jmb == "")){

				array_push($errors, "Sva polja moraju biti popunjena!");
				return $errors;
			}
			if($name_office!=''){
					
				if(!preg_match("/^([A-Z]{1}[a-z]+[( |\-){1}[A-Z]*[a-z]*[0-9]*]*)$/", $name_office)){
					
					array_push($errors, "Naziv nije validan!");
				}
			}
			if(count($location)!=0){
				for($i=0;$i<count($location);$i++){
					
					if($location[$i]!=''){
        				$n = $i+1;
        				if(!preg_match("/^([A-Z]{1}[a-z]+[( |\-|\.){1}[A-Z]*[a-z]*[0-9]*]*)$/", $location[$i])){
								
							array_push($errors, "Lokacija  $n nije validna!");
	
						}
								
        			}
        		}	
			}
			if($phone!=''){

				if(!preg_match("/^([+]381( |\-)*[0-9]{2,}[( |\-)*[0-9]{3,}]*)$/", $phone)){
						
					array_push($errors, "Broj telefona nije validan!");

				}
			}	
			if($email!=''){
				if(!preg_match("/^([_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3}))$/", $email)){
							
					array_push($errors, "E-mail nije validan!");
	
				}
			}
			
			return $errors;
		}
	}
	
?>