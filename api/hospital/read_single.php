<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/conn.php';
  include_once '../../models/hospital.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate hospital object
  $hospital = new hospitals($db);

  // Check if there the url has the id
 isset($_GET['hosp_id']) ? : die();

  // Get a hospital
  $hospital->get_single();

  // Create array
  $hospital_arr = array(
    'hosp_id'=> $hospital->hosp_id,
    'hosp_name' => $hospital->hosp_name,
    'LGA'=>$hospital->LGA,
    'contact_no'=> $hospital->contact_no,
    'no_of_staff'=> $hospital->no_of_staff,
    'location' =>$hospital->location,
    'email' =>$hospital->email,
    'GRM' =>$hospital->GRM
  );

  // Make JSON
  echo json_encode($hospital_arr, JSON_PRETTY_PRINT);