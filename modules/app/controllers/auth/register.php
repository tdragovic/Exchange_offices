<?php
    if($_SERVER['REQUEST_METHOD'] === "POST") {
        if($_POST['next_step']){
           include('./modules/app/models/auth/register.php');

            if(isset($errors)) {
                if(count($errors)!=0){
                    $errors_print = implode('<br>',$errors);
                }
            } 
               
            $map_reg = array('ERRORS' => $errors_print);
            $register = file_get_contents('./modules/app/views/pages/auth/register.html');
            echo screen_print($register,$map_reg);
            unset($errors);
            echo $package; 
        }else{
            $map_reg = array('ERRORS' => '');
            $register = file_get_contents('./modules/app/views/pages/auth/register.html');
            echo screen_print($register,$map_reg);
        }
    }else{
            $map_reg = array('ERRORS' => '');
            $register = file_get_contents('./modules/app/views/pages/auth/register.html');
            echo screen_print($register,$map_reg);
    }
    
?>



