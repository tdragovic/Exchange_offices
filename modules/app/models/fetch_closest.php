<?php
    include "../../db/connection.php";
    include("./../../../functions/functions_api.php");

    $lat = $lat1 = $_POST['lat'];
    $lng = $lng1 =$_POST['lng'];
    
    $api = 'AIzaSyBJBn7elZA5meKmAECWwDy3jT9480ULzB4';
    $start = "$lat,$lng";
    $destinations = ''; # '44.8175329,20.4179972';

    // $stmt = $conn->prepare('SELECT * FROM exchange_office_location');
    $stmt = $conn->prepare('SELECT *, 6371 * 2 * ASIN(SQRT( POWER(SIN((? - exchange_office_lat) *  pi()/180 / 2), 2) +COS(? * pi()/180)
    * COS(exchange_office_lat * pi()/180) * POWER(SIN((? - exchange_office_lng) * pi()/180 / 2), 2) )) AS distance FROM exchange_office_location ORDER BY distance LIMIT 0,5');
    $stmt->bind_param('sss', $lat, $lat, $lng);
    $stmt->execute();
    $results = $stmt->get_result();

    # PRAVIMO $destinations za api_url

    foreach ($results as $key => $result) {
        $lat = $result['exchange_office_lat'];
        $lng = $result['exchange_office_lng'];
        $ids[] = $result['exchange_office_id'];
        if($key == 0) {
            $destinations = $lat . ',' . $lng;
        } else {
            $destinations .= "|" . $lat . ',' . $lng;
        }
    }

    #racunamo razdaljinu i potrebno vreme

    $drivingDist = calcDrivingMulti($start, $destinations, $api, $conn);
    $walkingDist = calcWalkingMulti($start, $destinations, $api, $conn);

    #racunamo najblize preko formule u bazi radi uporede, i radi koriscenja tacnih imena ulica posto gugl api malo baguje

    $closestDb = getClosestDb($lat1, $lng1, $conn);
    foreach ($drivingDist as $key => $value) {
        $time = $value[2];
        $dist = $value[1];
        $dist = substr($dist, 0, strpos($dist, ' '));
        $dist = (double)($dist);
        $drivingDistances[] = $dist;
    }
    foreach ($walkingDist as $key => $value) {
        $time = $value[2];
        $dist = $value[1];
        $dist = substr($dist, 0, strpos($dist, ' '));
        $dist = (double)($dist);
        $walkingDistances[] = $dist;
    }

    #sortiramo distance od najmanje ka najvecoj
    sort($drivingDistances);
    sort($walkingDistances);

    #pravimo 5 najblizih

    foreach($drivingDistances as $key => $value) {
        if(count($drivingDistances) == count($drivingDist)) {
            foreach ($drivingDist as $key => $dist) {
                if($value == $dist[1]) {
                    $one = array($dist[0], $dist[1], $dist[2]);
                    $closest_driving[] = $one;
                }
            }
        }
    }

    foreach($walkingDistances as $key => $value) {
        if(count($walkingDistances) == count($walkingDist)) {
            foreach ($walkingDist as $key => $dist) {
                if($value == $dist[1]) {
                    $one = array($dist[0], $dist[1], $dist[2]);
                    $closest_walking[] = $one;
                }
            }
        }
    }

    $closest_5_driving = array_slice($closest_driving, 0, 5);
    $closest_5_walking = array_slice($closest_walking, 0, 5);
    $currencies = array(1,2,3,4,5);

    foreach($ids as $key => $id) {
        $stmt = $conn->prepare('SELECT * FROM currency_list WHERE exchange_office_id = ? AND (currency_id BETWEEN ? AND ?) ORDER BY currency_id');
        $stmt->bind_param('ddd', $id, $currencies[0], $currencies[count($currencies)-1]);
        $stmt->execute();
        $results = $stmt->get_result();
        foreach ($results as $key => $row) {
            $sell_rate = $row['sell_rate'];
            $buy_rate = $row['buy_rate'];
            $rate = array($sell_rate, $buy_rate);
            $rates[] = $rate;
        }
    }
?>

<?php
    $format = "
    <div class='row mt-5'>
        <table class='table table-bordered text-center table-hover'>
            <thead>
                <tr>
                    <th rowspan='2' class='align-middle'>Menjacnica</th>
                    <th rowspan='2' class='align-middle'>Lokacija</th>
                    <th colspan='2' class='align-middle'>Eur</th>
                    <th rowspan='2' class='align-middle'>Razdaljina kolima</th>
                    <th rowspan='2' class='align-middle'>Vreme kolima</th>
                    <th rowspan='2' class='align-middle'>Razdaljina pesice</th>
                    <th rowspan='2' class='align-middle'>Vreme pesice</th>
                </tr>
                <tr>
                    <td class='align-middle'>Prodajni kurs</td>
                    <td class='align-middle'>Kupovni kurs</td>
                </tr>
            </thead>
            <tbody>
                    %s
            </tbody>
        </table>
    </div>";
    $table = "<tr>
                <td class='align-middle'>%s</td>
                <td class='align-middle'>%s</td>
                <td class='align-middle'>%s</td>
                <td class='align-middle'>%s</td>
                <td class='align-middle'>%s</td>
                <td class='align-middle'>%s</td>
                <td class='align-middle'>%s</td>
                <td class='align-middle'>%s</td>
            </tr>";
    $form = "";
    for($i = 0; $i < 5; $i++) {
        
        $form .= sprintf($table, $closestDb[$i][2], $closestDb[$i][3], $rates[$i][0], $rates[$i][1], $closest_5_driving[$i][1], $closest_5_driving[$i][2], $closest_5_walking[$i][1], $closest_5_walking[$i][2]);
    }
    $output = sprintf($format, $form);
    echo $output;
?>