<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../../config/conn.php";
include_once "../../models/staff.php";

$database = new database;
$db = $database->connect();

$staff = new staffs($db);

$data = json_decode(file_get_contents("php://input"));

//Set id to update
$staff->doc_id = $data->doc_id;

//Delete staff
if ($staff->delete()) {
    echo json_encode(
        array('Message' => 'staff Deleted successfully')
    );
} else {
    array('Message' => 'staff not Deleted successfully');
}


