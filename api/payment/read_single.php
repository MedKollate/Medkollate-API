<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/conn.php';
  include_once '../../models/payment.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate payment object
  $payment = new payments($db);

  // Check if there the url has the id
  isset($_GET['pay_id']) ? : die();

  // Get a payment
  $payment->get_single();

  // Create array
  $payment_arr = array(
    'pay_id'=> $payment->pay_id,
    'pat_id' => $payment->pat_id,
    'amount'=>$payment->amount,
    'pay_time'=> $payment->pay_time,
    'pay_type'=> $payment->pay_type,
    'pay_date' =>$payment->pay_date
  );

  // Make JSON
  echo json_encode($payment_arr, JSON_PRETTY_PRINT);