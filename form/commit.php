<?php
require_once("config.php");

function commit($data) {
	$user = USERNAME;
	$password = PASSWORD;
	$spreadsheetKey = SPREADSHEETKEY;

	set_include_path(get_include_path() . dirname(__FILE__) . PATH_SEPARATOR . "lib" . PATH_SEPARATOR . "zend");
	require_once("Zend/Loader.php");
	Zend_Loader::loadClass('Zend_Http_Client');
	@Zend_Loader::loadClass('Zend_Gdata');
	Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
	Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');

	$service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
	$client = Zend_Gdata_ClientLogin::getHttpClient($user, $password, $service);
	$spreadsheetService = new Zend_Gdata_Spreadsheets($client);

	$query = new Zend_Gdata_Spreadsheets_DocumentQuery();
	$query->setSpreadsheetKey($spreadsheetKey);
	$feed = $spreadsheetService->getWorksheetFeed($query);

	$worksheets = array();
	foreach($feed->entries as $entry) {
		$worksheets[$entry->title->text] = basename($entry->id);
	}

	$timestamp = time();

// saving records
	$worksheetId = reset($worksheets);
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
	$insertedListEntry = $spreadsheetService->insertRow($rowData, $spreadsheetKey, $worksheetId);

// saving server sales
	$worksheetId = end($worksheets);
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
		$insertedListEntry = $spreadsheetService->insertRow($rowData, $spreadsheetKey, $worksheetId);
	}
	return true;
}