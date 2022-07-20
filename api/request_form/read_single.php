<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/conn.php';
  include_once '../../models/request_form.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate request_form object
  $request_form = new request_forms($db);

  // Check if there the url has the id
isset($_GET['request_id']) ? : die();

  // Get a request_form
  $request_form->get_single();

  // Create array
  $request_form_arr = array(
    'request_id'=> $request_form->request_id,
    'sub_position' => $request_form->sub_position,
    'email'=>$request_form->email,
    'phone_no'=> $request_form->phone_no,
    'description'=> $request_form->description
  );

  // Make JSON
  echo json_encode($request_form_arr, JSON_PRETTY_PRINT);