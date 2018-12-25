<?php
    include "../../db/connection.php";
    
    $search = $conn->real_escape_string($_POST['search_box']);
    $sql = "SELECT exchange_office.exchange_office_name, exchange_office.exchange_office_id, exchange_office.exchange_office_phone, exchange_office_email, exchange_office_location, currency_list.currency_id, currency_list.sell_rate, currency_list.avg_rate, currency_list.buy_rate FROM exchange_office LEFT JOIN currency_list ON exchange_office.exchange_office_id = currency_list.exchange_office_id LEFT JOIN exchange_office_location ON exchange_office.exchange_office_id = exchange_office_location.exchange_office_id WHERE exchange_office_name LIKE '%$search%' AND currency_id = 1 AND activation = '1' GROUP BY exchange_office_name";
    $res = $conn->query($sql);
    
    if($res->num_rows > 0) {
        $output = "<h4>Search Result</h4>";
        foreach($res as $key => $value) {
            print_r($value);
            $name = $value['exchange_office_name'];
            $ids = $value['exchange_office_id'];
            $phone = $value['exchange_office_phone'];
            $email = $value['exchange_office_email'];
            $sell_rate = $value['sell_rate'];
            $avg_rate = $value['avg_rate'];
            $buy_rate = $value['buy_rate'];
            $location = $value['exchange_office_location'];
            $output = sprintf("<tr colspan='6'>
                                <td scope='col' class='text-center align-middle'>%s</td>
                                <td scope='col' class='text-center align-middle'>%s</td>
                                <td scope='col' class='text-center align-middle'>%s</td>
                                <td scope='col' class='text-center align-middle'>%s</td>
                                <td scope='col' class='text-center align-middle'>%s<br>%s</td>
                                <td scope='col' class='text-center align-middle'>%s</td>
                                <td scope='col' class='text-center align-middle'><a href='../pages/profile.php?id=%s' class='badge badge-dark'>Detaljniji pogled</a></td>
                            </tr>", $name, $sell_rate, $avg_rate, $buy_rate, $phone, $email, $location, $ids);
            echo $output;
        }
    } else {
        echo "<td colspan='7'><h4>Ne postoji trazena menjacnica</h4></td>";
    }
?>