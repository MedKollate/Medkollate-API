<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/conn.php';
  include_once '../../models/staff.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate staff object
  $staff = new staffs($db);

  // Check if there the url has the id
  isset($_GET['staff_id']) ? : die();

  // Get a staff
  $staff->get_single();

  // Create array
  $staff_arr = array(
    'staff_id'=> $staff->staff_id,
    'name' => $staff->name,
    'address'=>$staff->address,
    'department'=> $staff->department,
    'salary'=> $staff->salary,
    'email' =>$staff->email,
    'phone' =>$staff->phone,
    'emergency_contact' =>$staff->emergency_contact,
    'state' =>$staff->state
  );

  // Make JSON
  echo json_encode($staff_arr, JSON_PRETTY_PRINT);


  
  
  
  