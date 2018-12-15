<?php
    function insertExchangeOfficePackage($exchange_office_id, $package_id, $date, $end_date, &$conn) {
        $stmt = $conn->prepare('INSERT INTO exchange_office_package (exchange_office_id, package_id, start_date, end_date) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ddss', $exchange_office_id, $package_id, $date, $end_date);
        $stmt->execute();
    }
    function insertCurrencyList($exchange_office_id, $sell_rate, $avg_rate, $buy_rate, $date, &$conn) {
        $stmt = $conn->prepare('SELECT * FROM currency');
        $stmt->execute();
        $result = $stmt->get_result();
        foreach ($result as $key => $row) {
            $currency_id = $row['currency_id'];
            $stmt = $conn->prepare('INSERT INTO currency_list (exchange_office_id, currency_id, sell_rate, avg_rate, buy_rate, date) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->bind_param('ddssss', $exchange_office_id, $currency_id, $sell_rate, $avg_rate, $buy_rate, $date);
            $stmt->execute();
        }
    }

    function deleteUser($email, $conn) {
        $stmt = $conn->prepare('DELETE FROM user WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
    }
    function deleteExchangeOffice($exchange_office_id, $conn) {
        $stmt = $conn->prepare('DELETE FROM exchange_office WHERE exchange_office_id = ?');
        $stmt->bind_param('s', $exchange_office_id);
        $stmt->execute();
    }
    function deleteExchangeOfficePackage($exchange_office_id, $conn) {
        $stmt = $conn->prepare('DELETE FROM exchange_office_package WHERE exchange_office_id = ?');
        $stmt->bind_param('s', $exchange_office_id);
        $stmt->execute();
    }
    function deleteCurrencyList($exchange_office_id, $conn) {
        $stmt = $conn->prepare('DELETE FROM currency_list WHERE exchange_office_id = ?');
        $stmt->bind_param('s', $exchange_office_id);
        $stmt->execute();
    }
    function deleteExchangeOfficeLocation($exchange_office_id, $conn) {
        $stmt = $conn->prepare('DELETE FROM exchange_office_location WHERE exchange_office_id = ?');
        $stmt->bind_param('s', $exchange_office_id);
        $stmt->execute();
    }
    
    function delete($email, $conn) {
        $stmt = $conn->prepare('SELECT user.user_id, exchange_office_id FROM user INNER JOIN exchange_office ON user.user_id = exchange_office.user_id WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        foreach ($result as $key => $row) {
            $user_id = $row['user_id'];
            $exchange_office_id = $row['exchange_office_id'];
        }
        if(isset($exchange_office_id)) {
            deleteUser($email, $conn);
            deleteExchangeOffice($exchange_office_id, $conn);
            deleteExchangeOfficePackage($exchange_office_id, $conn);
            deleteCurrencyList($exchange_office_id, $conn);
            deleteExchangeOfficeLocation($exchange_office_id, $conn);
            $report = "Nalog sa datim e-mailom je uspešno obrisan";
            return true;
        }
        $report = "Ne postoji nalog sa datim e-mailom";
        return false;
    }
    
?>