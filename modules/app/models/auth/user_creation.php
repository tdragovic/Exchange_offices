<?php
  
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $exchange_office_name = $_POST['exchange_office_name'];
    $exchange_office_phone ="+381" . $_POST['exchange_office_phone'];
    $exchange_office_email = $_POST['exchange_office_email'];
    $exchange_office_pib = $_POST['exchange_office_pib'];
    $exchange_office_jmb = $_POST['exchange_office_jmb'];
                    
        foreach($_POST as $key => $value) {
            if (strpos($key, 'location') === 0) {
                $exchange_office_location[] = trim($value);
            }
        }
                
    if(empty($username) || empty($exchange_office_name) || empty($exchange_office_pib) || empty($exchange_office_jmb)) {
        $errors[] = "Sva polja moraju biti popunjena!";
    }else{
        if(!checkUsername($username)){
            $errors[] = 'Neispravno korisnicko ime!';
        }
        if(!checkExchangeName($exchange_office_name)) {
            $errors[] = 'Neispravan naziv menjacnice!';
        }
        if(!checkPib($exchange_office_pib)) {
            $errors[] = 'Neispravan pib!';
        }
        if(!checkJmb($exchange_office_jmb)) {
            $errors[] = 'Neispravan jmb!';
        }
        if(!checkPhone($exchange_office_phone)){
            $errors[] = "Broj telefona nije validan!";
        }

                    
        if(count($exchange_office_location)!=0){
            for($i=0;$i<count($exchange_office_location);$i++){
                if($exchange_office_location[$i]!=''){
                    $n = $i+1;
                    if(!checkLocation($exchange_office_location[$i])){
                        array_push($errors, "Lokacija  $n nije validna!");
                    }
                                    
                }
            }   
        }
    }
        if(count($errors)==0){
                    
            $stmt = $conn->prepare("INSERT INTO user (username,password,email) VALUES (?, '123', ?)");
            $stmt->bind_param('ss', $username, $user_email);
            $stmt->execute();
            $stmt = $conn->prepare("SELECT `user_id` FROM user WHERE username = ?");
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $res = $stmt->get_result();
            if($res->num_rows > 0) {
                $row = $res->fetch_assoc();
                $user_id = $row['user_id'];
            }
            $stmt = $conn->prepare("INSERT INTO exchange_office(exchange_office_name,`user_id`, exchange_office_phone, exchange_office_email, exchange_office_pib, exchange_office_jmb) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('sdssss', $exchange_office_name, $user_id, $exchange_office_phone, $exchange_office_email, $exchange_office_pib, $exchange_office_jmb);
            $stmt->execute();
            $stmt = $conn->prepare("SELECT exchange_office_id FROM exchange_office WHERE `user_id` = ?");
            $stmt->bind_param('d', $user_id);
            $stmt->execute();
            $res = $stmt->get_result();
                    if($res->num_rows > 0) {
                        $row = $res->fetch_assoc();
                        $exchange_office_id = $row['exchange_office_id'];
                    }
                    foreach ($exchange_office_location as $key => $value) {
                        $stmt = $conn->prepare("INSERT INTO exchange_office_location(exchange_office_id,    exchange_office_location) VALUES (?, ?)"); 
                        $stmt->bind_param('ds', $exchange_office_id, $value);
                        $stmt->execute();
                    }

                    if(isset($exchange_office_id)) {
                        header("location: index.php?page=profile&id=$exchange_office_id");
                    }
        }
            
            
?>
