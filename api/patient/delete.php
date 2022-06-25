<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../../config/conn.php";
include_once "../../models/patient.php";

$database = new database;
$db = $database->connect();

$patient = new patients($db);

$data = json_decode(file_get_contents("php://input"));

//Set id to update
$patient->pat_id = $data->pat_id;

//Delete patient
if ($patient->delete()) {
    echo json_encode(
        array('Message' => 'patient Deleted successfully')
    );
} else {
    array('Message' => 'patient not Deleted successfully');
}


