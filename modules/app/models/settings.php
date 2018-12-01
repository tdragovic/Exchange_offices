<?php 
        
        $password = getPassword($_SESSION['exchange_office_name']);

        if(isset($_POST['password']) && isset($_POST['new_password']) && isset($_POST['password_confirm'])) {
            
                $pass = $_POST['new_password'];
                $pass_conf = $_POST['password_confirm']; 
               
                if($password!==$_POST['password']){
                    $errors[] = 'Neispravna lozinka!';
                }
                if(strlen($pass)<6 || strlen($pass_conf)<6){
                    $errors[] = 'Minimalno 6 karaktera za lozinku!';
                }else{
                    if($pass!=$pass_conf){
                        $errors[] = 'Lozinke se ne podudaraju!';
                    }
                }

                if(count($errors)==0){
                    $stmt = $conn->prepare("UPDATE user LEFT JOIN exchange_office ex ON user.user_id = ex.user_id SET password = ? WHERE exchange_office_name = ?");
                    $stmt->bind_param('ss', $pass, $_SESSION['exchange_office_name']);
                    $stmt->execute();

                    header("location: index.php?page=success");
                }
        }else{
             $errors[] = 'Popunite sva polja!';
        }
    
?>