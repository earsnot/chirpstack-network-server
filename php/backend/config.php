<?php

$testing = false;

$fileName = $testing ? "chirpstack-network-server.toml"
	: "/etc/chirpstack-network-server/chirpstack-network-server.toml";

$options = [
	"rx_window" => ["[0-9]+", function($x) { return (int)$x; }, function($x) { return $x >= 0 && $x <= 2; }],
	"rx1_delay" => ["[0-9]+", function($x) { return (int)$x; }, function($x) { return $x >= 1 && $x <= 15; }],
	"disable_adr" => ["(?:true|false)", function($x) { return $x === "true"; }, function($x) { return true; }]
];
