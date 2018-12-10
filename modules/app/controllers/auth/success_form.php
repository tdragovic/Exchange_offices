<?php
    if($_SERVER['REQUEST_METHOD'] === "POST") {
        if(isset($_POST['next_submit']) && $_POST) {
            include "./modules/app/models/auth/success_form.php";
            if($success_form) {
                include "./modules/app/views/pages/notifications/success_form.php";
                echo $date;
            } else {
                include "./modules/app/views/pages/notifications/error.php";
            }
        } else {
            #MARKERI
        }
    }
?>