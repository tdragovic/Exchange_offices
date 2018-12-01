<?php
    if($_SERVER['REQUEST_METHOD'] === "POST") {
         if($_POST['send_form']){
           include('./modules/app/models/auth/register.php');

            if(isset($errors)) {
                if(count($errors)!=0){
                    $errors_print = implode('<br>',$errors);
                }
            } 
               
            $map_reg = array('ERRORS' => $errors_print,'EMAIL' => $_POST['user_email'],'NAME' => $_POST['user_name'], 'PIB' => $_POST['user_pib'],'LOCATION' => $_POST['user_location']);
            $register = file_get_contents('./modules/app/views/pages/auth/register.html');
            echo screen_print($register,$map_reg);
            unset($errors);
        }else{
            $map_reg = array('ERRORS' => '','EMAIL' => '','NAME' => '', 'PIB' => '','LOCATION' => '');
            $register = file_get_contents('./modules/app/views/pages/auth/register.html');
            echo screen_print($register,$map_reg);
        }
    }else{
            $map_reg = array('ERRORS' => '','EMAIL' => '','NAME' => '', 'PIB' => '','LOCATION' => '');
            $register = file_get_contents('./modules/app/views/pages/auth/register.html');
            echo screen_print($register,$map_reg);
    }
    
?>



