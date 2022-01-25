#!/usr/bin/env php
<?php

require_once __DIR__ . "/config.php";

if(PHP_SAPI != "cli") {
	echo "This script can only be run from the CLI.\n";
	exit(1);
}

if($argc < 2) {
	echo "Usage: php {$argv[0]} <option> [<value>]\n";
	exit(1);
}

$option = $argv[1];

if(!isset($options[$option])) {
	echo "Invalid option: $option.\n";
	exit(1);
}

$valuePattern = $options[$option][0];
$fromString = $options[$option][1];
$isValid = $options[$option][2];

$pattern = "/^([ \t]*" . preg_quote($option) . "[ \t]*=[ \t]*)($valuePattern)([ \t]*)$/m";

$file = file_get_contents($fileName);
$count = preg_match_all($pattern, $file, $matches, PREG_SET_ORDER);

if($count !== 1) {
	echo "Unexpected match count (expected 1, was $count).\n";
	exit(1);
}

if(isset($argv[2])) {
	$value = $argv[2];

	if(!preg_match("/^$valuePattern$/", $value)) {
		echo "Invalid value.\n";
		exit(1);
	}

	$convertedValue = $fromString($value);

	if(!$isValid($convertedValue)) {
		echo "Invalid value.\n";
		exit(1);
	}

	$encodedValue = json_encode($convertedValue);
	$replacement = $matches[0][1] . $encodedValue . $matches[0][3];

	$output = str_replace($matches[0][0], $replacement, $file);
	$oCount = preg_match_all($pattern, $output, $oMatches, PREG_SET_ORDER);
	
	if($oCount !== 1) {
		echo "Error while updating configuration file.\n";
		exit(1);
	}

	file_put_contents($fileName, $output);
	
	if(!$testing) {
		exec("kill $(ps aux | grep '[c]hirpstack-network-server' | awk '{print $2}')");
		exec("/usr/bin/chirpstack-network-server");
	}
	
	echo "{$oMatches[0][2]}\n";
}
else {
	echo "{$matches[0][2]}\n";
}
