<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../../config/conn.php";
include_once "../../models/request_form.php";

$database = new database;
$db = $database->connect();

$request_form = new request_forms($db);

$data = json_decode(file_get_contents("php://input"));

//Set id to update
$request_form->request_id = $data->request_id;

$request_form->name = $data->name;
$request_form->sub_position = $data->sub_position;
$request_form->date = $data->date;
$request_form->phone = $data->phone;
$request_form->gmail = $data->gmail;
$request_form->description = $data->description;

//Update request_form
if ($request_form->update()) {
    echo json_encode(
        array('Message' => 'request_form updated successfully')
    );
} else {
    array('Message' => 'request_form not updated successfully');
}


