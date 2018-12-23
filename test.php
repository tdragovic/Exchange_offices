<?php
    include "./modules/db/connection.php";   
    include "./functions/functions_db.php";
    $success_form = false;

    $package = $_POST['package'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = ($_POST['password']);   #md5
    $activate = 1;
    $date = date('Y-m-d', time());

    switch ($package) {
        case 'package1':
            $package_id = 1;
            $end_date = date('Y-m-d', strtotime($date .' + 92 days'));
            break;
        case 'package2':
            $package_id = 2;
            $end_date = date('Y-m-d', strtotime($date .' + 185 days'));
            break;
        case 'package3':
            $package_id = 3;
            $end_date = date('Y-m-d', strtotime($date .' + 366 days'));
            break;
        default:
            $pack = $package;
            break;
    }

    $stmt = $conn->prepare('INSERT INTO user (username, password, email) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $username, $password, $email);
    $stmt->execute();

    $stmt = $conn->prepare('SELECT user_id FROM user WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
    }

    $stmt = $conn->prepare('INSERT INTO exchange_office (user_id, activation) VALUES (?, ?)');
    $stmt->bind_param('dd', $user_id, $activate);
    $stmt->execute();
    echo $user_id;
    $stmt = $conn->prepare('SELECT * FROM exchange_office WHERE user_id = ?');
    $stmt->bind_param('d', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $exchange_office_id = $row['exchange_office_id'];
    }
    echo $exchange_office_id;

    // $stmt = $conn->prepare('INSERT INTO exchange_office_package (exchange_office_id, package_id, start_date, end_date) VALUES (?, ?, ?, ?)');
    // $stmt->bind_param('ddss', $exchange_office_id, $package_id, $date, $end_date);
    // $stmt->execute();

    insertExchangeOfficePackage($exchange_office_id, $package_id, $date, $end_date, $conn);

    $stmt = $conn->prepare('SELECT * FROM exchange_office_package WHERE exchange_office_id = ?');
    $stmt->bind_param('d', $exchange_office_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $success_form = true;
    }

    // $stmt = $conn->prepare('SELECT * FROM currency');
    // $stmt->execute();
    // $result = $stmt->get_result();
    // foreach ($result as $key => $row) {
    //     $currency_id = $row['currency_id'];
    //     $rates = array(0, 0, 0);
    //     $stmt = $conn->prepare('INSERT INTO currency_list (exchange_office_id, currency_id, sell_rate, avg_rate, buy_rate, date) VALUES (?, ?, ?, ?, ?, ?)');
    //     $stmt->bind_param('ddssss', $exchange_office_id, $currency_id, $rates[0], $rates[1], $rates[2], $date);
    //     $stmt->execute();
    // }
    $rates = array(0, 0, 0);
    insertCurrencyList($exchange_office_id, $rates[0], $rates[1], $rates[2], $date, $conn);

    

    $key = md5($username);
    $send_to = $email;
    $caption = "Verifikacija naloga - Menjator";
    $message = "
    Molimo Vas da verifikujete e-mail klikom na link,
    <a href='localhost/eo/index.php?page=verify&key=" .
    $key . "'>localhost/eo/index.php?page=verify&key=" . $key . "</a>
    kako biste mogli da koristite Vaš nalog,

    Pozdrav,
    Tim Menjator
    ";

    echo $message;
?>