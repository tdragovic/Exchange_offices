<?php
session_start();
include("./modules/db/connection.php");
include("./functions/functions.php"); 
include("./functions/functions_reg.php");
$header = file_get_contents('./modules/app/views/inc/header.html');
$date = date("Y-m-d", time());
$errors = array();
$titles = array(
			'' => 'Menjator',
			'home' => 'Menjator',
			'about' => 'Menjator - O nama',
			'contact' => 'Menjator - Kontakt',
			'profile' => 'Menjator - Profil',
			'register' => 'Menjator - Registracija',
			'user_creation' => 'Menjator - Kreiranje korisnika',
			'admin_login' => 'Menjator - Prijava',
			'login' => 'Menjator - Prijava',
			'logout' => 'Menjator - Odjava',
			'success' => 'Menjator',
			'success_form' => 'Menjator',
			'settings' => 'Menjator - Podesavanja'
		);
if($_SESSION) {
	if(isset($_SESSION['logged']) && $_SESSION['logged']) {
            $username = $_SESSION['username'];
            $id = $_SESSION['id'];
            $stmt = $conn->prepare("SELECT * FROM exchange_office WHERE exchange_office_id=?");
            $stmt->bind_param('s', $id);
            $stmt->execute();
            $res = $stmt->get_result();
            $row = $res->fetch_assoc();
            $exchange_office_name = $row['exchange_office_name'];
            $user = 'user';
        } elseif (isset($_SESSION['logged_admin']) && $_SESSION['logged_admin']) {
            $username = $_SESSION['username'];
            $user = 'admin';
        } else {
        	include("./modules/app/views/pages/notifications/error.php");
			include("./modules/app/views/inc/footer.html");
			exit;
       }
}else{
	$user = 'anonymous';
	$username='anonymous';
}

if($_GET){
	if(isset($_GET['page'])){

		$page = $_GET['page'] ?? '';
		
		if(isset($_GET['id'])){
			$get_id = $_GET['id'] ?? '';
			$profile = checkProfile($get_id);
			
			$stmt = $conn->prepare("SELECT * FROM exchange_office WHERE exchange_office_id=?");	
			$stmt->bind_param('d',$get_id);
			$stmt->execute();
			$res = $stmt->get_result();
			if($res->num_rows > 0) {
				$row = $res->fetch_assoc();
				$user_id = $row['user_id'];
				$exchange_office_id = $row['exchange_office_id'];
				$exchange_office_name = $row['exchange_office_name'];
			}
		}
		if(isset($_GET['action'])){
			$action = $_GET['action'] ?? '';
			if(($action!='edit_profile' && $action!='edit_currencylist')||
				($action=='edit_profile' && $user!='admin')||
				($action=='edit_currencylist' && $user!='user')){
					include("./modules/app/views/pages/notifications/error.php");
					include("./modules/app/views/inc/footer.html");
					exit;
			}
		}

		foreach($titles as $key => $value){
			if($page==$key){
				$map_header = array('TITLE' => $value);
				echo screen_print($header,$map_header);
				echo screen_print_nav_bar($user,$username);
			}
		}
		
		
		switch ($page) {
			case '' :
				include('./modules/app/views/pages/home.php');
				break;
			case 'home' :
				include('./modules/app/views/pages/home.php');
				break;
			case 'about' :
				include('./modules/app/views/pages/about.html');
				break;
			case 'contact' :
				include('./modules/app/controllers/contact.php');
				break;
			case 'search_box' :
				include('./modules/app/views/pages/home.php');
				break;
			case 'settings' :
				if($user=='user'){
					include('./modules/app/controllers/settings.php');
				}else{
					include('./modules/app/views/pages/notifications/error.php');
				}
				break;	
			case 'success' :
				if($user=='user'){
					include('./modules/app/views/pages/notifications/success.html');
				}else{
					include('./modules/app/views/pages/notifications/error.php');
				}
				break;
			case 'success_form' :
				if($user=='anonymous'){
					include('./modules/app/views/pages/notifications/success_form.html');
				}else{
					include('./modules/app/views/pages/notifications/error.php');
				}
				break;
			case 'login' :
				if($user=='anonymous'){
					include('./modules/app/controllers/auth/auth.php');
				}elseif($user=='user'){
					include('./modules/app/views/pages/notifications/user_loggedin.html');
				}elseif($user=='admin'){
					include('./modules/app/views/pages/notifications/admin_loggedin.html');
				}else{
					include('./modules/app/views/pages/notifications/error.php');
				}
				break;
			case 'register' :
				if($user=='anonymous'){
					include('./modules/app/controllers/auth/register.php');
				}elseif($user=='user'){
					include('./modules/app/views/pages/notifications/user_loggedin.html');
				}elseif($user=='admin'){
					include('./modules/app/views/pages/notifications/admin_loggedin.html');
				}else{
					include('./modules/app/views/pages/notifications/error.php');
				}
				break;
			case 'admin_login' :
				if($user=='admin'){
					include('./modules/app/views/pages/notifications/admin_loggedin.html');
				}elseif($user=='user'){
					include('./modules/app/views/pages/notifications/error.php');
				}else{
					include('./modules/app/controllers/auth/admin_login.php');
				}
				break;
			case 'user_creation' :
				if($user=='admin'){
					include('./modules/app/controllers/auth/user_creation.php');
				}else{
					include('./modules/app/views/pages/notifications/error.php');
				}
				break;
			case 'logout' :
				if($user=='admin' || $user=='user'){
					include('./modules/app/controllers/auth/logout.php');
				}else{
					include('./modules/app/views/pages/notifications/error.php');
				}
				break;
			case 'profile' :
				if($profile){
					include("./modules/app/views/pages/profile/profile.php");
				}else{
					include('./modules/app/views/pages/notifications/error.php');
				}
				
				break;
			default :
				$map_header = array('TITLE' => 'error');
				echo screen_print($header,$map_header);
				echo screen_print_nav_bar($user,$username);
				include('./modules/app/views/pages/notifications/error.php');
				break;
		}

	}else{
		$map_header = array('TITLE' => $titles['home']);
		echo screen_print($header,$map_header);
		echo screen_print_nav_bar($user,$username);
		include('./modules/app/views/pages/home.php');
	}
}else{
	$map_header = array('TITLE' => $titles['home']);
	echo screen_print($header,$map_header);
	echo screen_print_nav_bar($user,$username);
	include('./modules/app/views/pages/home.php');
}	

include("./modules/app/views/inc/footer.html");
?>