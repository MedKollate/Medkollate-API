<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once "../../config/conn.php";
include_once "../../models/complaint.php";

$database = new database;
$db = $database->connect();

$complaint = new complaints($db);

$result = $complaint->get();

$num_rows = mysqli_num_rows($result);

if ($num_rows > 0) {
    $complaint_arr = array();
    $complaint_arr['data'] = array();

    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);

        $complaint_item = array(
            'complaint_id' => $complaint_id,
            'complaint_name' => $complaint_name,
            'complaint' => $complaint,
        );

        array_push($complaint_arr['data'], $complaint_item);

        
    }

    echo json_encode($complaint_arr, JSON_PRETTY_PRINT);
} else {
    echo json_encode(array('message' => 'No row in table'));
}