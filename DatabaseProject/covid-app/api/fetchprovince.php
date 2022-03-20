<?php
$host = "localhost:3306";
$user = "root";
$password = "";
$dbname = "databaseproject";

$con = mysqli_connect($host, $user, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
$provinces = array();

$sql_select = "select * from province_covid";

$results = mysqli_query($con,$sql_select);

foreach ( $results as $value) {
    $province = new stdClass();
    $province->name = $value['Province'];
    $provinces[] = $province;
}




echo json_encode(array_values($provinces));
