<?php
    include_once "../../../../functions/functions_reg.php";
    include "../../../db/connection.php";
    $errors = array();

    if(isset($_POST['email'])) {
        $email = $_POST['email'];
        checkMailReg($email, $conn, $errors);
    }
    if(isset($_POST['username'])) {
        $username = $_POST['username'];
        echo checkUsernameReg($username, $conn, $errors);
    }
    // if(isset($_POST['password']) && isset($_POST['password_confirm'])) {
    //     $password = $_POST['password'];
    //     $password_confirm = $_POST['password_confirm'];
    //     checkPassword($password, $password_confirm);
    // }
    if(!empty($errors)) {
        foreach($errors as $key => $value) {
            echo $value;
        }
    }
?>