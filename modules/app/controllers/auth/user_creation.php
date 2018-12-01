<?php
    if($_SERVER['REQUEST_METHOD'] === "POST") {
         if($_POST['save_profile']){
           include('./modules/app/models/auth/user_creation.php');

            if(isset($errors)) {
                if(count($errors)!=0){
                    $errors_print = implode('<br>',$errors);
                }
            } 
               
            $map_user_creation = array('ERRORS' => $errors_print,'USERNAME' => $_POST['username'],'EMAIL' => $_POST['user_email'], 'EXCHANGE_OFFICE_NAME' => $_POST['exchange_office_name'], 'LOCATION_0' => $_POST['location0'], 'PHONE' => $_POST['exchange_office_phone'],'EMAIL_OFFICE' => $_POST['exchange_office_email'], 'PIB' => $_POST['exchange_office_pib'], 'JMB' => $_POST['exchange_office_jmb']);
            $user_creation = file_get_contents('./modules/app/views/pages/auth/user_creation.html');
            echo screen_print($user_creation, $map_user_creation);
            unset($errors);
        }else{
            $map_user_creation = array('ERRORS' => '', 'USERNAME' => '', 'EMAIL' => '', 'EXCHANGE_OFFICE_NAME' => '', 'LOCATION_0' => '', 'PHONE' => '','EMAIL_OFFICE' => '', 'PIB' => '', 'JMB' => '');
            $user_creation = file_get_contents('./modules/app/views/pages/auth/user_creation.html');
            echo screen_print($user_creation, $map_user_creation);
        }
    }else{
           $map_user_creation = array('ERRORS' => '', 'USERNAME' => '', 'EMAIL' => '', 'EXCHANGE_OFFICE_NAME' => '', 'LOCATION_0' => '', 'PHONE' => '','EMAIL_OFFICE' => '', 'PIB' => '', 'JMB' => '');
            $user_creation = file_get_contents('./modules/app/views/pages/auth/user_creation.html');
            echo screen_print($user_creation, $map_user_creation);
    }
               
                   
            
?>
