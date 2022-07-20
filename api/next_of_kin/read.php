<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once "../../config/conn.php";
include_once "../../models/next_of_kin.php";

$database = new database;
$db = $database->connect();

$next_of_kin = new next_of_kins($db);

$result = $next_of_kin->get();

$num_rows = mysqli_num_rows($result);

if ($num_rows > 0) {
    $next_of_kin_arr = array();
    $next_of_kin_arr['data'] = array();

    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);

        $next_of_kin_item = array(
            'kin_id' => $kin_id,
            'name' => $name,
            'phone_no' => $phone_no,
            'email' => $email,
            'relationship' => $relationship,
            'address' => $address
        );

        array_push($next_of_kin_arr['data'], $next_of_kin_item);

        
    }

    echo json_encode($next_of_kin_arr, JSON_PRETTY_PRINT);
} else {
    echo json_encode(array('message' => 'No data in register'));
}