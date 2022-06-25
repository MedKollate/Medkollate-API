<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../../config/conn.php";
include_once "../../models/schedule.php";

$database = new database;
$db = $database->connect();

$schedule = new schedules($db);

$data = json_decode(file_get_contents("php://input"));

//Set id to update
$schedule->appoint_id = $data->appoint_id;

$schedule->pat_id = $data->pat_id;
$schedule->doc_id = $data->doc_id;
$schedule->appoint_time = $data->appoint_time;

//Update schedule
if ($schedule->update()) {
    echo json_encode(
        array('Message' => 'schedule updated successfully')
    );
} else {
    array('Message' => 'schedule not updated successfully');
}


