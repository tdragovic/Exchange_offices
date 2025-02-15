var x = document.getElementById("lng");
var y = document.getElementById('lat');

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    x.innerHTML = position.coords.longitude;
    y.innerHTML = position.coords.latitude;
}

// Isto kao gore, uzimamo lokaciju zapisujemo u hidden div

var $lat = document.getElementById("profile_lat");
var $lng = document.getElementById('profile_lng');

function getPositionProfile() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPositionProfile);
    } else { 
        $lng.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPositionProfile(position) {
    $lat.innerHTML = position.coords.latitude;
    $lng.innerHTML = position.coords.longitude;
}

$(document).ready(function() {

    // var eo_name = $('#eo_name').text();
    
    
    // tek kada se upisu vrednosti u #lng/#lat da posalje ajax, ne pre
    $('#lat').bind("DOMSubtreeModified", function(){
        var lat = $('#lat').text();
        var lng = $('#lng').text();
        if(lat != "" && lng != "") {
            $.ajax({
                url: './modules/app/models/fetch_closest.php',
                method: 'post',
                data: {lat: lat, lng: lng},
                dataType: 'text',
                beforeSend: function() {
                    $("#loading-ajax").show();
                },
                success: function(data) {
                    $('#info').html(data);
                    $('#container').show();
                }
             });
        }

    });

    if($('.eo_name')) {
        var eo_name = $('.eo_name').text();
    } else {
        var eo_name = ' Frange Menjacnica';
    }
    getPositionProfile();
   
    // Tek kada se upisu vrednosti u profile_lng da se salje ajax sa trenutnom lokacijom, nazivom menjacnice
    $('#profile_lng').bind("DOMSubtreeModified", function(){
        var lat = $('#profile_lat').text();
        var lng = $('#profile_lng').text();
        console.log($lat);
        console.log($lng);
        if($lat != "" && $lng != "") {
            $.ajax({
                type: 'post',
                url: "./modules/app/views/pages/profile/fetch_profile.php",
                data: {exchange_office_name: eo_name, latitude: lat, longitude: lng},
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    // pravi se gugl mapa sa koordinatama prve menjacnice u JSONU, trebalo bi da je ta najbliza
                    var map = initMap(data[0].lat, data[0].lng);
                    
        
                    $.each(data, function() {
                        // postavljaju se markeri za each element json-a, tj svaku menjacnicu
                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(this.lat, this.lng),
                            map: map,
                            title: eo_name,
                        });
                    });
                }
            });
        } else {
            console.log('Ne valja');
        }
    });
    
    
    

    $("#search_box").keyup(function(e) {
        e.preventDefault();
        var text = $(this).val();
        if(text == '') {
            //$('#container_daily').show();
            $('#currency_body').show();
            $('#container_table').hide();
        } else {
            //$('#container_daily').hide();
            $('#currency_body').hide();
            $('#container_table').show();

            $.ajax({
                url: './modules/app/models/fetch.php',
                method: 'post',
                data: {search_box:text},
                dataType: 'text',
                success: function(data) {
                    $('#container_table').html(data);
                }
            });
        }
    });
    
    $("#reg_user_mail").keyup(function(e) {
        var text = $(this).val();
        if(text.length > 5) {
            $.ajax({
                url: './modules/app/models/auth/check_reg.php',
                method: 'post',
                data: {email: text},
                dataType: 'text',
                success: function(data) {
                    $('#err1').html(data);
                }
            });
        }
    });
    
    $('#reg_user_mail').focusout(function(e) {
        var text = $(this).val();
        var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i

        if(!pattern.test(text)) {
            $('#err1').html('E-mail adresa je nevažeća');
        } else if(text.indexOf('@') > -1) {
            
            $.ajax({
                url: './modules/app/models/auth/check_reg.php',
                method: 'post',
                data: {email: text},
                dataType: 'text',
                success: function(data) {
                    $('#err1').html(data);
                }
            });
            
        }
    });

    $("#reg_user_name").keyup(function(e) {
        var text = $(this).val();
        if(text.length > 5) {
            $.ajax({
                url: './modules/app/models/auth/check_reg.php',
                method: 'post',
                data: {username: text},
                dataType: 'text',
                success: function(data) {
                    $('#err2').html(data);
                }
            });
        }
    });

    $("#reg_user_name").focusout(function(e) {
        e.preventDefault();
        var text = $(this).val();

        if(text.length > 5) {
            $.ajax({
                url: './modules/app/models/auth/check_reg.php',
                method: 'post',
                data: {username: text},
                dataType: 'text',
                success: function(data) {
                    $('#err2').html(data);
                }
            }); 
        } else {
            $('#err2').html('Korisničko ime mora biti duže od 5 karaktera');
        }
    });

    $('#reg_pass').on('focusout', function(e) {
        var password = $('#reg_pass').val();
        var password_confirm = $('#reg_pass_confirm').val();

        if(password.length < 5 || password_confirm.length < 5) {
            $('#err3').html('Lozinka mora biti duža od 4 karaktera');
        } else {
            $('#err3').html('');
            if(password_confirm.length > 4) {
                if(password != password_confirm) {
                    $('#err4').html('Lozinke se razlikuju');
                } else {
                    $('#err4').html('');
                }
            }
        }
        
    });

    $('#reg_pass_confirm').keyup(function() {
        var password = $('#reg_pass').val();
        var password_confirm = $('#reg_pass_confirm').val();
        if(password != '' && password.length > 4 && password_confirm.length > 4) {
            if(password_confirm != password) {
                $('#err4').html('Lozinke se razlikuju');
            } else {
                $('#err4').html(''); 
            }
        }
    });
    

    $('#reg_pass_confirm').on('change', function(e) {
        var password = $('#reg_pass').val();
        var password_confirm = $('#reg_pass_confirm').val();
        if(password.length < 5 || password_confirm.length < 5) {
            $('#err3').html('Lozinka mora biti duža od 4 karaktera');
        } else {
            if(password != password_confirm) {
                $('#err4').html('Lozinke se razlikuju');
            } else {
                $('#err3').html('');
                $('#err4').html('');
            }
        }
    });
    
   
    
    
    $('#step2_reg input').focusout(function() {
        var empty = false;
        var err = false;
        $('#step2_reg input').each(function() {
            if($(this).val().length == 0) {
                empty = true;
            }
        });
        $('.err').each(function() {
            if($(this).text().length != 0) {
                err = true;
            }
        });
        if(empty) {
            $('#next2').attr('disabled', 'disabled'); 
        } else {
            if(err) {
                $('#next2').attr('disabled', 'disabled');
            } else {
                $('#next2').removeAttr('disabled');
            }
        }
        // console.log('Err: ' + err);
        // console.log('Empty: ' + empty);
    });

    $('#step3 input').on('change', function() {
        //var checked = $('input[name='']:checked"')
        if($('input[name=pay]:checked')) {
            if($("#invalidCheck3").is(':checked')) {
                $('#next_submit').removeAttr('disabled');
            } else {
                $('#next_submit').attr('disabled', 'disabled');
            }
        }
    });

    
});
//  Funkcija za kreiranje google mape
var map;
function initMap(lat, lng) {
      map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: new google.maps.LatLng(lat, lng),
    })
    return map;
}