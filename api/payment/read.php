<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once "../../config/conn.php";
include_once "../../models/payment.php";

$database = new database;
$db = $database->connect();

$payment = new payments($db);

$result = $payment->get();

$num_rows = mysqli_num_rows($result);

if ($num_rows > 0) {
    $payment_arr = array();
    $payment_arr['data'] = array();

    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);

        $payment_item = array(
            'pay_id' => $pay_id,
            'pat_id' => $pat_id,
            'amount' => $amount,
            'pay_time' => $pay_time,
            'pay_type' => $pay_type,
            'pat_date' => $pat_date
        );

        array_push($payment_arr['data'], $payment_item);

        
    }

    echo json_encode($payment_arr, JSON_PRETTY_PRINT);
} else {
    echo json_encode(array('message' => 'No data in register'));
}