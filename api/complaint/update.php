<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../../config/conn.php";
include_once "../../models/complaint.php";

$database = new database;
$db = $database->connect();

$complaint = new complaints($db);

$data = json_decode(file_get_contents("php://input"));

//Set id to update
$complaint->complaint_id = $data->complaint_id;

$complaint->complaiint_name = $data->complaiint_name;
$complaint->complaint = $data->complaint;

//Update complaint
if ($complaint->update()) {
    echo json_encode(
        array('Message' => 'Complaint updated successfully')
    );
} else {
    array('Message' => 'Complaint not updated successfully');
}


