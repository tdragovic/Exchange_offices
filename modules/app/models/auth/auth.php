<?php
   
   
        $username = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['password']);
        
         if(empty($username) || empty($password)){
                $errors[] = 'Sva polja moraju biti popunjena!';
        }else{
            if(!checkUsername($username)){
                $errors[] = 'Neispravni podaci!';
            }
            if(strlen($password) < 3){
                $errors[] = "Minimalno 3 karaktera za lozinku!";
            }
        }
        if(count($errors)==0){

            $stmt = $conn->prepare("SELECT username, password, ex.exchange_office_id, ex.exchange_office_name, exchange_office_phone, exchange_office_email, exchange_office_pib, exchange_office_jmb FROM user LEFT JOIN exchange_office ex ON ex.user_id = user.user_id WHERE username = ? AND password = ?");
            $stmt->bind_param('ss', $username, $password);
            $stmt->execute();
            $res = $stmt->get_result();
            if($res->num_rows > 0) {
                $row = $res->fetch_assoc();
                if($username == $row['username'] && $password == $row['password']) {
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['id'] = $row['exchange_office_id'];
                    $_SESSION['exchange_office_name'] = $row['exchange_office_name'];
                    $_SESSION['exchange_office_phone'] = $row['exchange_office_phone'];
                    $_SESSION['exchange_office_email'] = $row['exchange_office_email'];
                    $_SESSION['exchange_office_pib'] = $row['exchange_office_pib'];
                    $_SESSION['exchange_office_jmb'] = $row['exchange_office_jmb'];
                    $_SESSION['logged'] = true;
                    header("location: index.php?page=profile&id={$_SESSION['id']}");
                } else {
                    $errors[] = "Neispravni podaci!";
                }
            
            }else {
                    $errors[] = "Neispravni podaci!";
            }
        }

    
   
?>
