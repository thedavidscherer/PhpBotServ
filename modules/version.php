<?php

$classname = "Version";
class Version {
	function getName() {
		return "Version";
	}
	function getCommand() {
		return "version";
	}
	function handlesDirectCommands() {
		return true;
	}
	function handlesGlobalMessages() {
		return false;
	}
	function processCommand($fp, $line, $cmd) {
		fwrite($fp, "NOTICE {$line['nick']} :RomServ 2.0.0 Public Beta\n\r");
	}
}
?>
