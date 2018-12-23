$(document).ready(function() {
    
    $.ajax({
        type: "POST",
        url: "./modules/app/views/pages/profile/chart.php",
        data: {tip: 'grafik-line'},
        dataType: "json",
        beforeSend: function(){},
        complete: function(){},
        success: function(data) {
            console.log(data);
            alert(data);
            new Morris.Line({
                element: 'chart_prof',
                data: JSON.parse(data),
                xkey: 'datum',
                ykeys: ['Menjacnica', 'Valuta', 'Kupovni kurs', 'Srednji kurs', 'Prodajni kurs'],
                labels: ['Menjacnica', 'Valuta', 'Kupovni kurs', 'Srednji kurs', 'Prodajni kurs']
            });
        }
    });
});