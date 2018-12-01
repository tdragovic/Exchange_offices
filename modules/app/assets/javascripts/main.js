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
   /* $("#form1").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '../inc/fetch_form.php',
            method: 'post',
            data: $(this).serialize(),
            success: function(data) {
                alert(data);
            }
        });
        $(this).show();
        $('#info').hide();
    });*/
});