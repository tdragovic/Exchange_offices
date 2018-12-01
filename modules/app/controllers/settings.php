<?php 
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['password_change'])){
            include("./modules/app/models/settings.php");

            if(isset($errors)) {
                if(count($errors)!=0){
                    $errors_print = implode('<br>',$errors);
                }
            } 
               
			$map_settings = array('ERRORS' => $errors_print, 'PASSWORD' => $_POST['password'], 'NEW_PASSWORD' => $_POST['new_password'], 'CONFIRM_PASSWORD' => $_POST['password_confirm']);
            $settings = file_get_contents('./modules/app/views/pages/auth/settings.html');
            echo screen_print($settings,$map_settings);
            unset($errors);
        }else{
        	$map_settings = array('ERRORS' => '', 'PASSWORD' => '', 'NEW_PASSWORD' => '', 'CONFIRM_PASSWORD' => '');
            $settings = file_get_contents('./modules/app/views/pages/auth/settings.html');
            echo screen_print($settings,$map_settings);
        }
    }else{
        	$map_settings = array('ERRORS' => '', 'PASSWORD' => '','NEW_PASSWORD' => '', 'CONFIRM_PASSWORD' => '');
            $settings = file_get_contents('./modules/app/views/pages/auth/settings.html');
            echo screen_print($settings,$map_settings);
    }
?>