<?php

use LDAP\Result;

$host = "localhost:3306";
$user = "root";
$password = "";
$dbname = "databaseproject";

$con = mysqli_connect($host, $user, $password, $dbname);

$input = json_decode(file_get_contents('php://input'), true);

$mydate = getdate(date("U"));
$today = "$mydate[mday]-$mydate[mon]-$mydate[year]";
$today_format = date_format(date_create($today),"dMY");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql_select = "SELECT $today_format FROM province_covid";
try {
$dateResult = mysqli_query($con, $sql_select);
}
catch(Exception $e) {
    $dateResult = FALSE;
}
if ($dateResult) {
    print_r($today_format . "\r\n");
    print_r("Found current date \r\n");
} else {
    $addcolumn = "ALTER TABLE province_covid ADD $today_format int";
    $result_column = mysqli_query($con, $addcolumn);
    if ($result_column) {
        print_r("Success created new today column \r\n");
    } else {
        print_r("Failed to create new today column \r\n");
    }
}

foreach ($input as $key => $value) {
    print_r($key . " " . $value . "\r\n");
    if($value != null){
        $sql = "UPDATE province_covid SET $today_format = $value WHERE Province = '$key'";
        print_r($sql);
        $result = mysqli_query($con,$sql);
        print_r($result);
        if ($result) {
            print_r($key . 'Updated');
        } else {
            print_r("Updated " . $key . " failed \r\n");
        }
        }
    
}

echo json_encode('ok');
