<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../../config/conn.php";
include_once "../../models/complaint.php";

$database = new database;
$db = $database->connect();

$complaint = new complaints($db);

$data = json_decode(file_get_contents("php://input"));


$complaint->pat_id = $data->pat_id;
$complaint->doc_id = $data->doc_id;
$complaint->appoint_time = $data->appoint_time;

if ($complaint->create()) {
    echo json_encode(
        array('Message' => 'complaint created')
    );
} else {
    array('Message' => 'complaint not created');
}


