<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once "../../config/conn.php";
include_once "../../models/request_form.php";

$database = new database;
$db = $database->connect();

$request_form = new request_forms($db);

$result = $request_form->get();

$num_rows = mysqli_num_rows($result);

if ($num_rows > 0) {
    $request_form_arr = array();
    $request_form_arr['data'] = array();

    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);

        $request_form_item = array(
            'request_id' => $request_id,
            'name' => $name,
            'sub_position' => $sub_position,
            'date' => $date,
            'gmail' => $gmail,
            'description' => $description
        );

        array_push($request_form_arr['data'], $request_form_item);

        
    }

    echo json_encode($request_form_arr, JSON_PRETTY_PRINT);
} else {
    echo json_encode(array('message' => 'No doctor in register'));
}