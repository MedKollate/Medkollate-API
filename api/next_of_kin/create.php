<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../../config/conn.php";
include_once "../../models/next_of_kin.php";

$database = new database;
$db = $database->connect();

$next_of_kin = new next_of_kins($db);

$data = json_decode(file_get_contents("php://input"));


$next_of_kin->name = $data->name;
$next_of_kin->phone_no = $data->phone_no;
$next_of_kin->email = $data->gmail;
$next_of_kin->relationship = $data->relationship;
$next_of_kin->address = $data->address;

if ($next_of_kin->create()) {
    echo json_encode(
        array('Message' => 'next_of_kin created')
    );
} else {
    array('Message' => 'next_of_kin not created');
}


