<?php 
   
            
            if(isset($_POST['name']) && !empty($_POST['name']) &&
                isset($_POST['subject']) && !empty($_POST['subject']) &&
                isset($_POST['email']) && !empty($_POST['email']) &&
                isset($_POST['message_body']) && !empty($_POST['message_body'])){

                $name = $conn->real_escape_string($_POST['name']);
                $subject = $conn->real_escape_string($_POST['subject']);
                $email = $conn->real_escape_string($_POST['email']);
                $message_body = $conn->real_escape_string($_POST['message_body']);

                $errors = array();

                if(!preg_match('/^([A-Z]{1}[a-z]+[[ ][A-Z]{1}[a-z]*]*)$/', $name)){
                    $errors[] = "Ime nije validno";
                }
                if(!preg_match("/^([A-Z]+[ |\-]?[a-z]*[[ |\-]?[A-Z]*[a-z]*]*)$/", $subject)){
                    $errors[] = "Naslov nije validan";
                }
                if(!preg_match("/^([_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3}))$/", $email)){
                    $errors[] = "E-mail nije validan";
                }
                

            }else{
                $errors[] = "Sva polja moraju biti popunjena";
            }
            
            if(count($errors)==0){

                $send_to = "petar.stf@gmail.com";
                $caption = "(Kontakt e-mail)-".$subject;
                $message = "
                Od Mušterije:

                " . $message_body . "
                
                ";
                
                if(mail($send_to,$caption,$message)){
                    echo ("<script LANGUAGE='JavaScript'>
                        window.alert('Poruka uspešno poslata!');
                        window.location.href='index.php?pages=home';
                        </script>");
                    
                }else{
                    $errors[] = "Doslo je do greške, molimo Vas da pokušate ponovo!";
                }
                

            }
    
?>