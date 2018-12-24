google.charts.load('current', {'packages':['corechart']})
$(document).ready(function() {
    if($('.eo_name')) {
        var id = $('.eo_name').text();
    } else {
        var id = ' Frange Menjacnica';
    }

    $.ajax({
        type: 'post',
        url: "./modules/app/views/pages/profile/chart.php",
        data: {id: id},
        dataType: 'json',
        beforeSend: function(){},
        complete: function(){},
        success: function(data) {
            // console.log(data);
            // alert((data));
            // drawLine((data));
            var arr = $.map(data, function(el) { return el; });
            // console.log(arr);
            Morris.Line({
                element: 'chart_prof',
                data: data,
                xkey: 'datum',
                hideHover: true,
                ymin: 'auto',
                ymax: 'auto',
                numLines: 10,
                resize: true,
                lineColors: ['blue', 'red', 'black'],
                postUnits: ' RSD',
                ykeys: ['Kupovni_kurs', 'Srednji_kurs', 'Prodajni_kurs'],
                labels: ['Kupovni_kurs', 'Srednji_kurs', 'Prodajni_kurs']
            });
        }
    });
    // jsonData = $.map(data, function(el) {
    //     return el;
    // });

});
function convert(json) {
    $.map(json, function(el) {
        return el
    });
}
// function drawLine(json) {
//     var jsonData = $.ajax({
//         type: 'post',
//         url: "./modules/app/views/pages/profile/chart.php",
//         data: {tip: 'grafik-line'},
//         dataType: 'json',
//         beforeSend: function(){},
//         complete: function(){},
//         success: function(data) {
//             console.log(data);
//             alert((data));
//             drawLine((data));
//         }
//     });
//     jsonData = $.map(data, function(el) {
//         return el;
//     });

//     var data = new google.visualization.DataTable(jsonData);
//     var options = {
//         hAxis: {
//             title: 'Datum'
//         },
//         vAxis: {
//             title: 'Vrednost u dinarima'
//         },
//         legend: { position: 'right' }
//     };

//     var chart = new google.visualization.LineChart(document.getElementById('chart_prof'));
//     chart.draw(data, options);
// }
