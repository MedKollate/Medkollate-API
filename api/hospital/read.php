<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once "../../config/conn.php";
include_once "../../models/hospital.php";

$database = new database;
$db = $database->connect();

$hospital = new hospital($db);

$result = $hospital->get();

$num_rows = mysqli_num_rows($result);

if ($num_rows > 0) {
    $hospital_arr = array();
    $hospital_arr['data'] = array();

    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);

        $hospital_item = array(
            'hosp_name' => $hosp_name,
            'location' => $location,
            'doc_id' => $doc_id,
            'pat_id' => $pat_id,
            'appoint_id' => $appoint_id,
            'pay_id' => $pay_id
        );

        array_push($hospital_arr['data'], $hospital_item);

        
    }

    echo json_encode($hospital_arr, JSON_PRETTY_PRINT);
} else {
    echo json_encode(array('message' => 'No doctor in register'));
}