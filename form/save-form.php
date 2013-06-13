<?php
require_once("commit.php");
$data = $_POST;
if (!$data) die;

// var_dump($data);die;

if ( commit($data) ) {
	echo "Data is submitted!";
	die;
}