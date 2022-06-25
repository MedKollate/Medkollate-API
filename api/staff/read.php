<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once "../../config/conn.php";
include_once "../../models/staff.php";

$database = new database;
$db = $database->connect();

$staffs = new staffs($db);

$result = $staffs->get();

$num_rows = mysqli_num_rows($result);

if ($num_rows > 0) {
    $staff_arr = array();
    $staff_arr['data'] = array();

    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);

        $staff_item = array(
            'staff_id' => $staff_id,
            'name' => $name,
            'address' => $address,
            'department' => $department,
            'salary' => $salary,
            'email' => $email,
            'phone' => $phone,
            'emergency_contact' => $emergency_contact,
            'state' => $state
        );

        array_push($staff_arr['data'], $staff_item);

        
    }

    echo json_encode($staff_arr, JSON_PRETTY_PRINT);
} else {
    echo json_encode(array('message' => 'No row in table'));
}