<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once "../../config/conn.php";
include_once "../../models/schedule.php";

$database = new database;
$db = $database->connect();

$schedule = new schedules($db);

$result = $schedule->get();

$num_rows = mysqli_num_rows($result);

if ($num_rows > 0) {
    $schedule_arr = array();
    $schedule_arr['data'] = array();

    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);

        $schedule_item = array(
            'appoint_id' => $appoint_id,
            'pat_id' => $pat_id,
            'doc_id' => $doc_id,
            'appoint_time' => $appoint_time
        );

        array_push($schedule_arr['data'], $schedule_item);

        
    }

    echo json_encode($schedule_arr, JSON_PRETTY_PRINT);
} else {
    echo json_encode(array('message' => 'No row in table'));
}