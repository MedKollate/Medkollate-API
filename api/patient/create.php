<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../../config/conn.php";
include_once "../../models/patient.php";

$database = new database;
$db = $database->connect();

$patient = new patients($db);

$data = json_decode(file_get_contents("php://input"));


$patient->pat_name = $data->pat_name;
$patient->pat_addr = $data->pat_addr;
$patient->pat_sex = $data->pat_sex; 
$patient->pat_email = $data->pat_email;
$patient->pat_Dob = $data->pat_Dob;
$patient->pat_marital_status = $data->pat_marital_status;
$patient->pat_genotype = $data->pat_genotype;
$patient->pat_blood_group = $data->pat_blood_group;
$patient->pat_occupation = $data->occupation;
$patient->pat_allergy = $data->allergy;
$patient->pat_height = $data->height;
$patient->pat_weight = $data->weight;
$patient->pat_phone = $data->phone;

if ($patient->create()) {
    echo json_encode(
        array('Message' => 'patient created')
    );
} else {
    array('Message' => 'patient not created');
}


