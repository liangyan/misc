<?php
require_once("commit.php");
$data = $_POST;
if (!$data) die;

// var_dump($data);die;
// validation
$totalSales = 0;
foreach ($data["servers"] as $server) {
	$totalSales += $server["sales"];
}
if ( abs($totalSales - $data["total-sales"]) > 0.0001 ) {
	echo "Wrong sum. Please check your calculations.";
	die;
}


if ( commit($data) ) {
	echo "Data is submitted! <a href='http://aptgeo.com/daily_input/'>Enter Another Set of Data</a>";
	die;
}