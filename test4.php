<?php
    include "./modules/db/connection.php";   
    include "./functions/functions_db.php";

    if(isset($_POST['delete'])) {
        $email = $_POST['email'];
        if(delete($email, $conn)) {
            echo $report;
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{TITLE}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Oswald:700|Patua+One|Roboto+Condensed:700" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <link rel="stylesheet" href="./modules/app/assets/stylesheets/main.css">
    </head>
    <body onload='getLocation();'>
        <header>
            <nav class="navbar navbar-expand navbar-dark bg-dark">
                <div class="container">
                    <div class="col-2 mx-auto">
                    <a href="index.php?page=home" class="navbar-brand text-warning h1 mb-0 d-flex">
                        <div class="col-5 flex-col">
                            <img src="modules/app/assets/images/logo.png" alt="Logo loading" class="img-fluid">
                        </div>
                        <div class="col-6 flex-col my-auto">
                            Menjator
                        </div>
                    </a>
                    </div>
                    <div class="navbar-collapse mx-auto">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item mx-3"><a href="index.php?page=home" class="nav-link text-warning"><span class="link-text">Početna</span></a></li>
                            <li class="nav-item mx-3"><a href="index.php?page=about" class="nav-link text-warning"><span class="link-text">O aplikaciji</span></a></li>
                            <li class="nav-item mx-3"><a href="index.php?page=contact" class="nav-link text-warning"><span class="link-text">Kontakt</span></a></li>
                            <li class='nav-item dropdown'><a href='#' class='nav-link dropdown-toggle text-warning' id='navbarDropdown' role='button' data-toggle='dropdown'>{{USERNAME}}</a>
                                        <div class='dropdown-menu bg-dark' aria-labelledby='navbarDropdown'>
                                        <a href='index.php?page=user_creation' class='dropdown-item text-warning'><span class='link-text'>Kreiraj korisnika</span></a>
                                        <a href='index.php?page=logout' class='dropdown-item text-warning'><span class='link-text'>Odjavi se</span></a>
                                    </div>
                            
                            <!--
                                <li class="nav-item my-auto text-muted">or</li>
                                <li class="nav-item mx-3"><a href="../auth/register.php" class="nav-link text-warning">Sign up</a></li>
                            -->
                        </ul>
                        <form class="form-inline" action="index.php?page=home" method="get">
                            <input type="search" id="search_box" name="search_box" class="form-control mr-2" placeholder="Search" aria-label="Search" autocomplete="off">
                        </form>
                    </div>
                </div>
            </nav>
        </header>

<!-- TEST4 START -->

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

<!-- TEST4 END -->

<footer class="text-center bg-dark container-field" style="position: absolute; width: 100%; bottom: 0;">
        <h4 class="text-light">Pratite nas</h4>
        <ul class="list-inline banner-social-buttons m-3">
            <li class='list-inline-item'><a href="#" class="btn btn-default text-warning btn-lg"><i class="fab fa-twitter"> <span class="n-name">Twitter</span></i></a></li>
            <li class='list-inline-item'><a href="#" class="btn btn-default text-warning btn-lg"><i class="fab fa-facebook-f"> <span class="n-name">Facebook</span></i></a></li>
            <li class='list-inline-item'><a href="#" class="btn btn-default text-warning btn-lg"><i class="fab fa-instagram"> <span class="n-name">Instagram</span></i></a></li>
        </ul>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="./modules/app/assets/javascripts/main.js" type="text/javascript"></script>
    <script src="./modules/app/assets/javascripts/register.js" type="text/javascript"></script>
    <script src="./modules/app/assets/javascripts/exchange_info.js" type="text/javascript"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>