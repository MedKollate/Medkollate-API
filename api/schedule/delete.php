<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../../config/conn.php";
include_once "../../models/schedule.php";

$database = new database;
$db = $database->connect();

$schedule = new schedules($db);

$data = json_decode(file_get_contents("php://input"));

//Set id to update
$schedule->appoint_id = $data->appoint_id;

//Delete schedule
if ($schedule->delete()) {
    echo json_encode(
        array('Message' => 'schedule Deleted successfully')
    );
} else {
    array('Message' => 'schedule not Deleted successfully');
}


