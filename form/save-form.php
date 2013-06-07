<?php
require_once("commit.php");
$data = $_POST;
if (!$data) die;

// var_dump($data);die;

commit($data);