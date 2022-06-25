<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../../config/conn.php";
include_once "../../models/hospital.php";

$database = new database;
$db = $database->connect();

$hospital = new hospitals($db);

$data = json_decode(file_get_contents("php://input"));


$hospital->hosp_name = $data->hosp_name;
$hospital->LGA = $data->LGA;
$hospital->contact_no = $data->contact_no;
$hospital->no_of_staff = $data->no_of_staff;
$hospital->location = $data->location;
$hospital->gmail = $data->gmail;
$hospital->GRM = $data->GRM;

if ($hospital->create()) {
    echo json_encode(
        array('Message' => 'hospital created')
    );
} else {
    array('Message' => 'hospital not created');
}


