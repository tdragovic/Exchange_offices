<?php
    
    if($_SERVER['REQUEST_METHOD'] === "POST") {
        if($_POST['admin_login']){
           include('./modules/app/models/auth/admin_login.php');

            if(isset($errors)) {
                if(count($errors)!=0){
                    $errors_print = implode('<br>',$errors);
                }
            } 
               
			$map_admin_login = array('ERRORS' => $errors_print,'USERNAME' => $_POST['username'],'PASSWORD' => $_POST['password']);
            $admin_login = file_get_contents('./modules/app/views/pages/auth/admin_login.html');
            echo screen_print($admin_login,$map_admin_login);
            unset($errors);
        }else{
        	$map_admin_login = array('ERRORS' => '','USERNAME' => '','PASSWORD' => '');
            $admin_login = file_get_contents('./modules/app/views/pages/auth/admin_login.html');
            echo screen_print($admin_login,$map_admin_login);
        }
    }else{
        	$map_admin_login = array('ERRORS' => '','USERNAME' => '','PASSWORD' => '');
            $admin_login = file_get_contents('./modules/app/views/pages/auth/admin_login.html');
            echo screen_print($admin_login,$map_admin_login);
    }
        
    
    
?>