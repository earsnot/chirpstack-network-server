<?php
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/common.php";

header("Content-Type: application/json");

if(!isset($_GET["device_eui"]) || $_GET["device_eui"] === "") {
	exitWithError("No device EUI specified.");
}

$deviceEui = sanitizeDeviceEui($_GET["device_eui"]);

$redis = new Redis();
$redis->connect("localhost");
$sessionStr = $redis->get(sprintf("lora:ns:device:%s", $deviceEui));

if($sessionStr === false) {
	exitWithError("Device session not found.", 404);
}

$session = new \Storage\DeviceSessionPB();
$session->mergeFromString($sessionStr);

echo json_encode(["value" => bin2hex($session->getJoinEui())]);