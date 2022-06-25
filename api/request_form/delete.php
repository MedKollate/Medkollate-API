<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../../config/conn.php";
include_once "../../models/request_form.php";

$database = new database;
$db = $database->connect();

$request_form = new request_forms($db);

$data = json_decode(file_get_contents("php://input"));

//Set id to update
$request_form->request_id = $data->request_id;

//Delete request_form
if ($request_form->delete()) {
    echo json_encode(
        array('Message' => 'request_form Deleted successfully')
    );
} else {
    array('Message' => 'request_form not Deleted successfully');
}


