<?php 
	 		$username = $conn->real_escape_string($_POST['username']);
            $password = $conn->real_escape_string($_POST['password']);

            if(empty($username) || empty($password)){
                $errors[] = 'Sva polja moraju biti popunjena!';
            }else{
                if(!checkUsername($username)){
                    $errors[] = 'Neispravni podaci!';
                }
            }

            if(count($errors)==0){

                $stmt = $conn->prepare("SELECT admin_username, admin_password FROM `admin` WHERE admin_username = ? AND admin_password = ?");
                $stmt->bind_param('ss', $username, $password);
                $stmt->execute();
                $res = $stmt->get_result();
                if($res->num_rows > 0) {
                    $row = $res->fetch_assoc();
                
                    $_SESSION['username'] = $row['admin_username'];
                    $_SESSION['logged_admin'] = true;

                    header("location: index.php?page=home");
                } else {
                    $errors[] = "Neispravni podaci!";
                    
                }
            }
?>