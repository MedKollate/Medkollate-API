<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../../config/conn.php";
include_once "../../models/hospital.php";

$database = new database;
$db = $database->connect();

$hospital = new hospitals($db);

$data = json_decode(file_get_contents("php://input"));

//Set name to update
$hospital->hosp_name = $data->hosp_name;

$hospital->LGA = $data->LGA;
$hospital->contact_no = $data->contact_no;
$hospital->no_of_staff = $data->no_of_staff;
$hospital->location = $data->location;
$hospital->gmail = $data->gmail;
$hospital->GRM = $data->GRM;


//Update hospital
if ($hospital->update()) {
    echo json_encode(
        array('Message' => 'hospital updated successfully')
    );
} else {
    array('Message' => 'hospital not updated successfully');
}


