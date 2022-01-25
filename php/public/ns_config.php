<?php
require_once __DIR__ . "/common.php";
require_once "/opt/config.php";

header("Content-Type: application/json");

if(!isset($_GET["option"]) || $_GET["option"] === "") {
	exitWithError("No option specified.");
}

if(!isset($options[$_GET["option"]])) {
	exitWithError("Invalid option: {$_GET["option"]}.");
}

switch($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		$output = null;
		$result = exec("sudo /opt/ns_config.php " . escapeshellarg($_GET["option"]) . " 2>&1", $output, $errorCode);
		printNsConfigResult($result, $errorCode, $options[$_GET["option"]][1]);
		break;
		
	case "PUT":
		$request = parseJsonRequest();
		
		if(!isset($request["value"])) {
			exitWithError("No value specified.");
		}
		
		$output = null;
		$result = exec("sudo /opt/ns_config.php ". escapeshellarg($_GET["option"]) . " " . escapeshellarg(json_encode($request["value"])) . " 2>&1", $output, $errorCode);
		printNsConfigResult($result, $errorCode, $options[$_GET["option"]][1]);
		break;
		
	default:
		printError("Unsupported request method.", 405);
}