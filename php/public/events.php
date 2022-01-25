<?php
require_once __DIR__ . "/common.php";

header("Content-Type: application/json");

$pdo = new PDO($databases["as_events"]["dsn"], $databases["as_events"]["username"], $databases["as_events"]["password"]);

if(!isset($_GET["device_eui"]) || $_GET["device_eui"] === "") {
	exitWithError("No device EUI specified.");
}

$deviceEui = sanitizeDeviceEui($_GET["device_eui"]);

if(!isset($_GET["limit"]) || $_GET["limit"] === "") {
	exitWithError("No limit specified.");
}

$query_limit = $_GET["limit"];

$query = $pdo->prepare("SELECT
		id,
		received_at,
		encode(dev_eui, 'hex') AS dev_eui,
		device_name,
		application_id,
		application_name,
		frequency,
		dr,
		adr,
		f_cnt,
		f_port,
		hstore_to_json(tags) AS tags,
		encode(data, 'hex') AS data,
		rx_info,
		object,
		encode(dev_addr, 'hex') AS dev_addr,
		confirmed_uplink,
		tx_info
	FROM device_up
	WHERE dev_eui = decode(?, 'hex')
	ORDER BY received_at DESC
	LIMIT ?");
	$query->execute([$deviceEui, $query_limit]);

$rows = [];
foreach($query->fetchAll(PDO::FETCH_ASSOC) as $row) {
	$row["tags"] = json_decode($row["tags"], true);
	if(count($row["tags"]) === 0) {
		$row["tags"] = new stdClass();
	}
	$row["rx_info"] = json_decode($row["rx_info"], true);
	$row["object"] = json_decode($row["object"], true);
	$row["tx_info"] = json_decode($row["tx_info"], true);
	$rows[] = $row;
}

echo json_encode(["value"=>$rows]);