<?php
        if(empty($_POST['user_email']) || empty($_POST['user_name']) || empty($_POST['user_pib']) || empty($_POST['user_location'])) {
            $errors[] = "Sva polja moraju biti popunjena!";
            
        } else {
            #checkData();
            $send_to = "petar.stf@gmail.com";
            $name = $conn->real_escape_string($_POST['user_name']);
            $email = $conn->real_escape_string($_POST['user_email']);
            $pib = $conn->real_escape_string($_POST['user_pib']);
            $location = $conn->real_escape_string($_POST['user_location']);



            if($name){
                if(!checkUsername($name)){
                    $errors[] = "Neispravno korisnicko ime!";
                }

            }
            if($email){
                if(!preg_match("/^([_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3}))$/", $email)){
                    $errors[] = "Neispravna e-mail adresa!";
                }

            }
            if($pib){
                if(!checkPib($pib)){
                    $errors[] = "PIB je neispravan!";
                }
            }
            if($location){
                if(!checkLocation($location)){
                    $errors[] = "Neispravna lokacija!";
                }
            }
           
            if(count($errors)==0){
                 $caption = "Registarska forma";
                 $message = "
                 Naziv menjacnice: " . $name . "
                 E-mail: " . $email . "
                 PIB: " . $pib . "
                 Lokacija: " . $location . "
                 ";
                 
                 if(mail($send_to, $subject, $message)) {
                     header("location: index.php?page=success_form");
                 } else {
                     header("location: ./modules/app/views/pages/notifications/error.php");
                 }
            }
        }
    
?>



