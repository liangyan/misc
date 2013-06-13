<?php
require_once("config.php");
ini_set("auto_detect_line_endings", true);

function commit($data) {
	$timestamp = time();
	$dataDir = dirname(__FILE__) . "/data/";
	$files = array(
		"reports" => $dataDir."reports.csv",
		"servers" => $dataDir."servers.csv",
		"json" => $dataDir."json/{$timestamp}.json"
	);

// archiving raw input
	$fp = fopen($files["json"], 'w');
	fwrite($fp, json_encode($data));
	fclose($fp);

// saving records
	$fileName = $files["reports"];
	$rowData = array(
		"report-id" => $timestamp,
		"created-at" => date("Y-m-d H:i:s", $timestamp),
		"location" => $data["location"],
		"date" => $data["date"],
		"total-sales" => $data["total-sales"],
		"more-than-one-person" => $data["more-than-one-person"],
		"comments" => $data["comments"],
		"notes" => $data["notes"]
	);
	if ( !file_exists($fileName) ) {
		$headerRow = array_keys($rowData);
		$fp = fopen($fileName, 'w');
		fputcsv($fp, $headerRow, ";");
		fclose($fp);
	}
	$fp = fopen($fileName, 'a');
	fputcsv($fp, $rowData, ";");
	fclose($fp);

// saving server sales
	$fileName = $files["servers"];
	foreach ($data["servers"] as $server) {
		if ( !$server["no"] && !$server["sales"] ) continue;
		$rowData = array(
			"report-id" => $timestamp,
			"created-at" => date("Y-m-d H:i:s", $timestamp),
			"location" => $data["location"],
			"date" => $data["date"],
			"server-no" => $server["no"],
			"sales" => $server["sales"]
		);
		
		if ( !file_exists($fileName) ) {
			$headerRow = array_keys($rowData);
			$fp = fopen($fileName, 'w');
			fputcsv($fp, $headerRow, ";");
			fclose($fp);
		}
		$fp = fopen($fileName, 'a');
		fputcsv($fp, $rowData, ";");
		fclose($fp);
	}
	return true;
}