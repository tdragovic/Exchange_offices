// google.charts.load('current', {packages: ['corechart', 'bar']});
// google.charts.setOnLoadCallback(drawMaterial);

$(document).ready(function() {
    $('#table_chart').hover(function() {
        $(this).addClass(' btn-dark text-warning');
        $('#graph_chart').removeClass('btn-dark text-warning text-muted');
        $('#graph_chart').addClass('btn-muted')
    });

    $('#graph_chart').hover(function() {
        $(this).addClass(' btn-dark text-warning');
        $('#table_chart').removeClass('btn-dark text-warning text-muted');
        $('#table_chart').addClass('btn-muted')
    });

    $('#graph_chart').on('click', function() {
        $('#stats_table').hide();
        $('#chart_div').show();
    });
    $('#table_chart').on('click', function() {
        $('#stats_table').show();
        $('#chart_div').hide();
    });

    var $array = [];
    table = $('.table');
    table.find('tr').each(function () {
        var $arr = [];

        var tds = $(this).find('td');
        var months = tds.eq(0).text();
        var avg = tds.eq(1).text();
        var total = tds.eq(2).text();
        var min = tds.eq(3).text();
        var max = tds.eq(4).text();
        if(months != '') {
            $arr.push(months, avg, total, min, max);
        }
        if($arr != "") {
            $array.push($arr);
        }
    });
    console.log($array);
    drawMorris($array);
    
});

function drawMorris($array) {
    var months = [];
    var avg = [];
    var total = [];
    var min = [];
    var max = [];
    for(i = 0; i < 3; i++) {
        months.push($array[i][0]);
        avg.push($array[i][1]);
        total.push($array[i][2]);
        min.push($array[i][3]);
        max.push($array[i][4]);
    }
    // alert(months);
    // alert(avg)
    Morris.Bar({
        element: 'chart_div',
        data: [
        { mesec: months[0], avg: avg[0], total: total[0], min: min[0], max: max[0] },
        { mesec: months[1], avg: avg[1], total: total[1], min: min[1], max: max[1] },
        { mesec: months[2], avg: avg[2], total: total[2], min: min[2], max: max[2] },],
        xkey: 'mesec',
        ykeys: ['avg', 'total', 'min', 'max'],
        labels: ['Prosečna zarada po korisniku', 'Ukupna zarada', 'Najmanji paket kupljen', 'Najveci paket kupljen']
        });
        
}

