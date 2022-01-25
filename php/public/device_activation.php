<?php
require_once __DIR__ . "/common.php";

header("Content-Type: application/json");

if(!isset($_GET["device_eui"]) || $_GET["device_eui"] === "") {
	exitWithError("No device EUI specified.");
}

$deviceEui = sanitizeDeviceEui($_GET["device_eui"]);

$pdo = new PDO($databases["ns"]["dsn"], $databases["ns"]["username"], $databases["ns"]["password"]);

switch($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		$query = $pdo->prepare("SELECT
				id,
				created_at,
				encode(dev_eui, 'hex') AS dev_eui,
				encode(join_eui, 'hex') AS join_eui,
				encode(dev_addr, 'hex') AS dev_addr,
				dev_nonce,
				join_req_type
			FROM device_activation
			WHERE dev_eui = decode(?, 'hex')
			ORDER BY id DESC
			LIMIT 10");
		$query->execute([$deviceEui]);
		echo json_encode(["rows" => $query->fetchAll(PDO::FETCH_ASSOC)]);
		break;
		
	case "DELETE":
		$query = $pdo->prepare("DELETE
			FROM device_activation
			WHERE dev_eui = decode(?, 'hex')");
		if(!$query->execute([$deviceEui])) {
			exitWithError("Failed to delete rows from database.", 500);
		}
		echo json_encode([], JSON_FORCE_OBJECT);
		break;
		
	default:
		printError("Unsupported request method.", 405);
}