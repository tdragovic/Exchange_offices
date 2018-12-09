$(document).ready(function() {

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
                url: '../inc/fetch.php',
                method: 'post',
                data: {search_box:text},
                dataType: 'text',
                success: function(data) {
                    $('#container_table').html(data);
                }
            });
        }
    });
    
    
    
    $('#reg_user_mail').keyup(function(e) {
        var text = $(this).val();

        $.ajax({
            url: './modules/app/models/auth/check_reg.php',
            method: 'post',
            data: {email: text},
            dataType: 'text',
            success: function(data) {
                $('#err1').html(data);
            }
        });
        
    });

    $("#reg_user_name").keyup(function(e) {
        e.preventDefault();
        var text = $(this).val();

        $.ajax({
            url: './modules/app/models/auth/check_reg.php',
            method: 'post',
            data: {username: text},
            dataType: 'text',
            success: function(data) {
                $('#err2').html(data);
            }
        }); 
    });

    $('#reg_pass').on('change', function(e) {
        var password = $('#reg_pass').val();
        var password_confirm = $('#reg_pass_confirm').val();

        if(password != password_confirm) {
            $('#err3').html('Lozinke se razlikuju');
        } else {
            $('#err3').html('');
        }
    });


    

    $('#reg_pass_confirm').on('change', function(e) {
        var password = $('#reg_pass').val();
        var password_confirm = $('#reg_pass_confirm').val();
        
        if(password != password_confirm) {
            $('#err3').html('Lozinke se razlikuju');
        } else {
            $('#err3').html(''); 
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
});