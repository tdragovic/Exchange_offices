<?php
   
    if($_SERVER['REQUEST_METHOD'] === "POST") {
         if($_POST['login']){
           include('./modules/app/models/auth/auth.php');

            if(isset($errors)) {
                if(count($errors)!=0){
                    $errors_print = implode('<br>',$errors);
                }
            } 
               
            $map_login = array('ERRORS' => $errors_print,'USERNAME' => $_POST['username'],'PASSWORD' => $_POST['password']);
            $login = file_get_contents('./modules/app/views/pages/auth/auth.html');
            echo screen_print($login,$map_login);
            unset($errors);
        }else{
            $map_login = array('ERRORS' => '','USERNAME' => '','PASSWORD' => '');
            $login = file_get_contents('./modules/app/views/pages/auth/auth.html');
            echo screen_print($login,$map_login);
        }
    }else{
            $map_login = array('ERRORS' => '','USERNAME' => '','PASSWORD' => '');
            $login = file_get_contents('./modules/app/views/pages/auth/auth.html');
            echo screen_print($login,$map_login);
    }
   
?>
