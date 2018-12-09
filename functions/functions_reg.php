<?php
    function checkMailReg($mail, &$conn, &$errors) {
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param('s', $mail);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $errors[] = 'Već postoji nalog sa istim e-mailom';
        } else {
            $errors[] = '';
        }
    }
    function checkUsernameReg($username, &$conn, &$errors) {
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $errors[] = 'Već postoji nalog sa istim korisničkim imenom';
        } else {
            $errors[] = '';
        }
    }
?>