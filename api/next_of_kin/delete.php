<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../../config/conn.php";
include_once "../../models/next_of_kin.php";

$database = new database;
$db = $database->connect();

$next_of_kin = new next_of_kins($db);

$data = json_decode(file_get_contents("php://input"));

//Set id to update
$next_of_kin->kin_id = $data->kin_id;

//Delete next_of_kin
if ($next_of_kin->delete()) {
    echo json_encode(
        array('Message' => 'next_of_kin deleted successfully')
    );
} else {
    array('Message' => 'next_of_kin not deleted');
}


