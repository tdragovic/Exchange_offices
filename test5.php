<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{TITLE}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Oswald:700|Patua+One|Roboto+Condensed:700" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
        <link rel="stylesheet" href="./modules/app/assets/stylesheets/main.css">
    </head>
    <body onload='getLocation();'>
        <header>
            
        <div id='main' class='container'>
            <div id='info' class='info mx-auto' >
                <div class='row mx-auto'>
                    <div class='col align-middle card'>
                        <div class='row text-left h2 eo_name my-2'>Naziv Menjacnice</div>
                        <div class='row h6 my-2'>
                            <div class="col">
                                <div class='row my-2'><i class='fa fa-map-marker' aria-hidden='true'></i> Lokacija</div>
                                <div class='row my-2'>%s</div>
                            </div>
                        </div>
                        <p class='row my-2'>Kontakt</p>
                        <div id='contact_phone' class='row my-2'><i class='fa fa-phone' aria-hidden='true'></i> %s</div>
                        <div id='contact_email' class='row my-2'><i class='fa fa-envelope' aria-hidden='true'></i> %s</div>
                    </div>
                    <div class='col'>
                        <div id='map' class='row mx-auto h-100 card'></div>
                    </div>
                </div>
			</div>
        </div>
        
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="./modules/app/assets/javascripts/main.js" type="text/javascript"></script>
    <script src="./modules/app/assets/javascripts/register.js" type="text/javascript"></script>
    <script src="./modules/app/assets/javascripts/exchange_info.js" type="text/javascript"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript" src="./modules/app/assets/javascripts/chart.js"></script>
    <script>
      var map;
      function initMap() {
        center = {lat: -34.397, lng: 150.644};
        map = new google.maps.Map(document.getElementById('map'), {
          center: center,
          zoom: 8
        });
        var marker = new google.maps.Marker({position: center, map: map});
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJBn7elZA5meKmAECWwDy3jT9480ULzB4&callback=initMap"
    async defer></script>
    