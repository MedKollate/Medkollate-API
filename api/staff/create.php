<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../../config/conn.php";
include_once "../../models/staff.php";

$database = new database;
$db = $database->connect();

$staff = new staffs($db);

$data = json_decode(file_get_contents("php://input"));


$staff->name = $data->name;
$staff->address = $data->address;
$staff->specialization = $data->specialization;
$staff->salary = $data->salary;
$staff->email = $data->email;
$staff->phone = $data->phone;
$staff->emergency_contact = $data->emergency_contact;
$staff->state = $data->emergency_contact;


if ($staff->create()) {
    echo json_encode(
        array('Message' => 'staff created')
    );
} else {
    array('Message' => 'staff not created');
}


