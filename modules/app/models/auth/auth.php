<?php
   
   
        $username = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['password']);
        
        if (empty($username) || empty($password)) {
            $errors[] = 'Sva polja moraju biti popunjena!';
        } else {
            if(!checkUsername($username)){
                $errors[] = 'Neispravni podaci!';
            } elseif(strlen($password) < 5) {
                $errors[] = "Minimalno 5 karaktera za lozinku!";
            }
            
        }
        if (count($errors)==0) {
            $secret_key = '6LfKr4EUAAAAAM9By_G9z01r6VtQcaZquR4bzT1Z';
            $response_key = $_POST['g-recaptcha-response'];
            $user_ip = $_SERVER['REMOTE_ADDR'];

            $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$response_key&remoteip=$user_ip";

            $response = file_get_contents($url);
            $json = json_decode($response);
            if($json->success) {

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
            } else {
                $errors[] = 'Neispravni podaci!';
            }

        }

    
   
?>
