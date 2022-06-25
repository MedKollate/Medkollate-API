<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../../config/conn.php";
include_once "../../models/schedule.php";

$database = new database;
$db = $database->connect();

$schedule = new schedules($db);

$data = json_decode(file_get_contents("php://input"));


$schedule->pat_id = $data->pat_id;
$schedule->doc_id = $data->doc_id;
$schedule->appoint_time = $data->appoint_time;

if ($schedule->create()) {
    echo json_encode(
        array('Message' => 'schedule created')
    );
} else {
    array('Message' => 'schedule not created');
}


