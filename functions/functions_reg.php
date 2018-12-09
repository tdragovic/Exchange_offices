<?php
    function checkMailReg($mail, &$conn, &$errors) {
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param('s', $mail);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $errors[] = 'Već postoji nalog sa istim e-mailom';
        }
    }
    function checkUsernameReg($username, &$conn, &$errors) {
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $errors[] = 'Već postoji nalog sa istim korisničkim imenom';
        }
    }
    function checkPasswordReg($password, $password_confirm) {
        if($password === $password_confirm) {
            if(strlen($password) < 3) {
                $errors[] = 'Lozinka mora biti duža od 3 karaktera';
            }
        } else {
            $errors[] = 'Lozinke se ne podudaraju';
        }
    }
?>