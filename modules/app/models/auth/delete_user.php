<?php
    if(isset($_POST['delete'])) {
        $email = $_POST['email'];
        if(delete($email, $conn)) {
            if(isset($report)) {
                echo $report;
            }
        }
    }

?>

<div class="container-fluid">
    <form action="" class="form col-lg-3 col-md-6 col-sm-12 mx-auto text-center mt-5" method='post'>
        <div class="form-group">
            <input type="text" name='email' class="form-control" placeholder='Enter e-mail'>
        </div>
        <input type="submit" name='delete' class="btn btn-dark text-warning" value='Obriši'>
    </form>
    <div class="col-6">
        <p class="col-6">
            <?php
                if(isset($report)) {
                    echo $report;
                }
            ?>
        </p>
    </div>
</div>