<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../../config/conn.php";
include_once "../../models/complaint.php";

$database = new database;
$db = $database->connect();

$complaint = new complaints($db);

$data = json_decode(file_get_contents("php://input"));

// Check if there the url has the id
isset($_GET['complaint_id']) ? : die();

//Delete complaint
if ($complaint->delete()) {
    echo json_encode(
        array('Message' => 'Complaint Deleted successfully')
    );
} else {
    array('Message' => 'Complaint not Deleted');
}


