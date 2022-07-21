<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/conn.php';
  include_once '../../models/complaint.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate complaints object
  $complaint = new complaints($db);

  // Check if there the url has the id
  isset($_GET['complaint_id']) ? : die();

  // Get a complaint
  $complaint->get_single();

  // Create array
  $complaint_arr = array(
    'complaint_id'=> $complaint->complaint_id,
    'complaint_name' => $complaint->complaint_name,
    'complaint'=>$complaint->complaint
  );

  // Make JSON
  echo json_encode($complaint_arr, JSON_PRETTY_PRINT);