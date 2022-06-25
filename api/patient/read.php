<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once "../../config/conn.php";
include_once "../../models/patient.php";

$database = new database;
$db = $database->connect();

$patients = new patients($db);

$result = $patients->get();

$num_rows = mysqli_num_rows($result);

if ($num_rows > 0) {
    $patients_arr = array();
    $patients_arr['data'] = array();

    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);

        $patients_item = array(
            'pat_id' => $pat_id,
            'pat_name' => $pat_name,
            'pat_addr' => $pat_addr,
            'pat_sex' => $pat_sex,
            'pat_email' => $pat_email,
            'pat_Dob' => $pat_Dob,
            'pat_marital_status' => $pat_marital_status,
            'pat_genotype' => $pat_genotype,
            'pat_blood_group' => $pat_blood_group,
            'pat_occupation' => $pat_occupation,
            'pat_allergy' => $pat_allergy,
            'pat_height' => $pat_height,
            'pat_weight' => $pat_weight,
            'pat_phone' => $pat_phone 
        );

        array_push($patients_arr['data'], $patients_item);

        
    }

    echo json_encode($patients_arr, JSON_PRETTY_PRINT);
} else {
    echo json_encode(array('message' => 'No row in table'));
}