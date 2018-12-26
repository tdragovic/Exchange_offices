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
<body>
    
    

    <div id="main" class="container">
        <div id='profile_lat'></div>
            <div id='profile_lng'></div>
			<div id='info' class='info mx-auto mt-3' >
                <div class='row mx-auto'>
                    <div class='col-12'>
						<div id='map' class='row mx-auto h-100 card' style='min-height:60vh;'></div>
					</div>
					<div class='col-12 align-middle'>
						<table class='table border table-borderless text-center'>
                            <thead>
                                <tr>
                                    <th rowspan='3' id='eo_name' class='eo_name align-bottom border-right'>%s</th>
                                    <th rowspan='2' class='align-middle border'><i class='fa fa-map-marker mr-2 ' aria-hidden='true'></i> Lokacija</th>
                                    <th colspan='2' class='align-middle border'>Kontakt</th>
                                </tr>
                                <tr>
                                    <th class='align-middle border'><i class='fa fa-phone my-auto' aria-hidden='true'></i></td>
                                    <th class='align-middle border'><i class='fa fa-envelope my-auto' aria-hidden='true'></i><span class='my-auto ml-2'></td>    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class='align-middle border-right'></td>
                                    <td class='align-middle border'><span class='align-middle my-auto'>%s</span></td>
                                    <td class='align-middle border'><span class='align-middle my-auto'>%s</span></td>
                                    <td class='align-middle border'><span class='align-middle my-auto'>%s</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>





                    <!-- STARI PROFIL -->
                    <div id='profile_lat'></div>
            <div id='profile_lng'></div>
			<div id='info' class='info mx-auto mt-3' >
                <div class='row mx-auto'>
                    <div class='col-12'>
						<div id='map' class='row mx-auto h-100 card' style='min-height:60vh;'></div>
					</div>
					<div class='col-12 align-middle border'>
						<div id='eo_name' class='col-4 border text-left h2 eo_name ml-2 my-2'>%s</div>
						<div class='col-4 border ml-2 my-2'>
							<div class='row'>
								<div class='col h6 my-2'><i class='fa fa-map-marker mr-2 ' aria-hidden='true'></i> Lokacija</div>
								<div class='col my-2'>%s</div>
							</div>
						</div>
						<p class='col-4 ml-2 h6 my-2'>Kontakt</p>
						<div id='contact_phone' class='col ml-2 my-2 align-middle'><i class='fa fa-phone my-auto' aria-hidden='true'></i><span class='my-auto ml-2'> %s</span></div>
						<div id='contact_email' class='col ml-2 my-2 align-middle'><i class='fa fa-envelope my-auto' aria-hidden='true'></i><span class='my-auto ml-2'> %s</span></div>
                    </div>
                    <div class='clearfix border'></div>
				</div>
			</div>
                <div class='clearfix border'></div>
			</div>
		</div>
    </div>















    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJBn7elZA5meKmAECWwDy3jT9480ULzB4&callback=initMap"
    async defer></script>
    
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript" src="./modules/app/assets/javascripts/chart.js"></script>
    <script type="text/javascript" src="./modules/app/assets/javascripts/prof_chart.js"></script>
    <script type="text/javascript" src="./modules/app/assets/javascripts/location.js"></script>
    <script src="./modules/app/assets/javascripts/main.js" type="text/javascript"></script>
    <script src="./modules/app/assets/javascripts/register.js" type="text/javascript"></script>
    <script src="./modules/app/assets/javascripts/exchange_info.js" type="text/javascript"></script>
</body>
</html>