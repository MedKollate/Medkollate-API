<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/conn.php';
  include_once '../../models/next_of_kin.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate next_of_kin object
  $next_of_kin = new next_of_kins($db);

 // Check if there the url has the id
  isset($_GET['kin_id']) ? : die();

  // Get a next_of_kin
  $next_of_kin->get_single();

  // Create array
  $next_of_kin_arr = array(
    'kin_id'=> $next_of_kin->kin_id,
    'name' => $next_of_kin->name,
    'phone_no'=>$next_of_kin->phone_no,
    'email'=> $next_of_kin->email,
    'relationship'=> $next_of_kin->relationship,
    'address' =>$next_of_kin->address
  );

  // Make JSON
  echo json_encode($next_of_kin_arr, JSON_PRETTY_PRINT);