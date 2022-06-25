<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../../config/conn.php";
include_once "../../models/staff.php";

$database = new database;
$db = $database->connect();

$staff = new staffs($db);

$data = json_decode(file_get_contents("php://input"));

//Set id to update
$staff->staff_id = $data->staff_id;

$staff->name = $data->name;
$staff->address = $data->address;
$staff->specialization = $data->specialization;
$staff->salary = $data->salary;
$staff->email = $data->email;
$staff->phone = $data->phone;
$staff->emergency_contact = $data->emergency_contact;
$staff->state = $data->state;


//Update staff
if ($staff->update()) {
    echo json_encode(
        array('Message' => 'staff updated successfully')
    );
} else {
    array('Message' => 'staff not updated');
}


