<?php 
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['send'])){
            include('./modules/app/models/contact.php');

            if(isset($errors)) {
                if(count($errors)!=0){
                    $errors_print = implode('<br>',$errors);
                }
            } 
               
			$map_contact = array('ERRORS' => $errors_print,'NAME' => $_POST['name'],'SUBJECT' => $_POST['subject'],'EMAIL' => $_POST['email'],'MESSAGE' => $_POST['message_body']);
            $contact = file_get_contents('./modules/app/views/pages/contact.html');
            echo screen_print($contact,$map_contact);
            unset($errors);
        }else{
        	$map_contact = array('ERRORS' => '','NAME' => '','SUBJECT' => '','EMAIL' => '','MESSAGE' => '');
            $contact = file_get_contents('./modules/app/views/pages/contact.html');
            echo screen_print($contact,$map_contact);
        }
    }else{
        	$map_contact = array('ERRORS' => '','NAME' => '','SUBJECT' => '','EMAIL' => '','MESSAGE' => '');
            $contact = file_get_contents('./modules/app/views/pages/contact.html');
            echo screen_print($contact,$map_contact);
    }
?>