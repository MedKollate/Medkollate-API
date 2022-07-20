<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/conn.php';
  include_once '../../models/schedule.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate schedule object
  $schedule = new schedules($db);

  // Check if there the url has the id
  isset($_GET['appoint_id']) ? : die();

  // Get a schedule
  $schedule->get_single();

  // Create array
  $schedule_arr = array(
    'appoint_id'=> $schedule->appoint_id,
    'pat_id' => $schedule->pat_id,
    'doc_id'=>$schedule->doc_id,
    'appoint_time'=> $schedule->appoint_time
  );

  // Make JSON
  echo json_encode($schedule_arr, JSON_PRETTY_PRINT);