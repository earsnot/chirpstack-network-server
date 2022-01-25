<?php
require_once __DIR__ . "/config.php";

function exitWithError($error, $httpCode = 400) {
	printError($error, $httpCode);
	exit;
}

function printError($error, $httpCode = 400) {
	http_response_code($httpCode);
	echo json_encode(["error" => $error]);
}

function printNsConfigResult($result, $errorCode, $convert) {
	if($errorCode !== 0) {
		printError(trim($result));
	}
	else {
		echo json_encode(["value" => $convert(trim($result))]);
	}
}

function parseJsonRequest() {
	$input = trim(file_get_contents("php://input"));
	$obj = json_decode($input, true);
	if(json_last_error() !== JSON_ERROR_NONE) {
		exitWithError("Unable to parse request: " . json_last_error_msg());
	}
	return $obj;
}

function sanitizeDeviceEui($input) {
	$deviceEui = trim($input);

	if(!preg_match("/^[a-fA-F0-9]{16}$/", $deviceEui)) {
		exitWithError("Invalid device EUI.");
	}
	
	return $deviceEui;
}