<?php
    include "modules/db/connection.php";
    $exchange_office_id = 1002;
    $curr_id = 'EUR';
    $stmt = $conn->prepare("SELECT * FROM all_time_currency INNER JOIN exchange_office ON all_time_currency.exchange_office_name = exchange_office.exchange_office_name  WHERE exchange_office_id = ? AND currency_label = ?");
    $stmt->bind_param('ds', $exchange_office_id, $curr_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $final = array();
    if($result->num_rows > 0) {
        foreach ($result as $key => $row) {
            $final[] = array(
                'Menjacnica' => $row['exchange_office_name'],
                'Valuta' => $row['currency_label'],
                'Kupovni kurs' => $row['sell_rate'],
                'Srednji kurs' => $row['avg_rate'],
                'Prodajni kurs' => $row['buy_rate'],
                'datum' => $row['date'],
            );
        }
        echo json_encode($final);
    } else {
        echo "FALSE";
        return false;
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
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
        <link rel="stylesheet" href="./modules/app/assets/stylesheets/main.css">
    </head>
    <body onload='getLocation();'>
        <header>
            

<div id="chart_prof" class='text-center'></div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="./modules/app/assets/javascripts/main.js" type="text/javascript"></script>
    <script src="./modules/app/assets/javascripts/register.js" type="text/javascript"></script>
    <script src="./modules/app/assets/javascripts/exchange_info.js" type="text/javascript"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript" src="./modules/app/assets/javascripts/chart.js"></script>