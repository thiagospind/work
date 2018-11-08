<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost","root","aapvr","phppot");

$sqlQuery = "SELECT student_id,student_name,marks FROM tbl_marks ORDER BY student_id";

$result = mysqli_query($conn,$sqlQuery);
//var_dump($result);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

//print_r($data);
echo json_encode($data);
?>