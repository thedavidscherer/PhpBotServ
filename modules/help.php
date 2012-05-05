<?php
$classname = 'Help';
class Help {
	function getName() {
		return 'Help';
	}
	function getCommand() {
		return 'help';
	}
	function handlesDirectCommands() {
		return true;
	}
	function handlesGlobalMessages() {
		return false;
	}
	function processCommand($fp, $line, $cmd) {
		if (isset ($cmd[1])) {
			if (file_exists('help/' . $cmd[1] . '.help')) {
				help($fp, 'help/' . $cmd[1] . '.help', $line['nick']);
			} else {
				fwrite($fp, "NOTICE {$line['nick']} :No help available for " . chr(2) . "{$cmd[1]}" . chr(2)."\n\r");
			}
		} else {
			$file = "help/default.help";
			help($fp, $file, $line['nick']);
		}
	}
}
?>
