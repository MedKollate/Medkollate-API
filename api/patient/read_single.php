<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/conn.php';
  include_once '../../models/patient.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate patient object
  $patient = new patients($db);

  // Get ID
  isset($_GET['pat_id']) ? : die();

  // Get a patient
  $patient->get_single();

  // Create array
  $patient_arr = array(
    'pat_id'=> $patient->pat_id,
    'pat_name' => $patient->pat_name,
    'pat_addr'=>$patient->pat_addr,
    'pat_sex'=> $patient->pat_sex,
    'pat_email'=> $patient->pat_email,
    'pat_Dob' =>$patient->pat_Dob,
    'pat_marital_status' => $patient->pat_marital_status,
    'pat_genotype'=>$patient->pat_genotype,
    'pat_blood_group'=> $patient->pat_blood_group,
    'pat_occupation'=> $patient->pat_occupation,
    'pat_allergy' =>$patient->pat_allergy,
    'pat_height'=> $patient->pat_height,
    'pat_weight' =>$patient->pat_weight,
    'pat_phone' =>$patient->pat_phone
  );

  // Make JSON
  echo json_encode($patient_arr, JSON_PRETTY_PRINT);