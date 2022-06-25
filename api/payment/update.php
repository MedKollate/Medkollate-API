<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../../config/conn.php";
include_once "../../models/payment.php";

$database = new database;
$db = $database->connect();

$payment = new payments($db);

$data = json_decode(file_get_contents("php://input"));

//Set id to update
$payment->pay_id = $data->pay_id;

$payment->pat_id = $data->pat_id;
$payment->amount = $data->amount;
$payment->pay_time = $data->pay_time;
$payment->pay_type = $data->pay_type;
$payment->pay_date = $data->pay_date;


//Update payment
if ($payment->update()) {
    echo json_encode(
        array('Message' => 'payment updated successfully')
    );
} else {
    array('Message' => 'payment not updated successfully');
}


