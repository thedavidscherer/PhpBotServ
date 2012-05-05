<?php
$classname = "Part";
class Part {
	function getName() {
		return "Part";
	}
	function getCommand() {
		return "part";
	}
	function handlesDirectCommands() {
		return true;
	}
	function handlesGlobalMessages() {
		return false;
	}
	function processCommand($fp, $line, $cmd) {
		if (getPerm($fp, $line['nick'], $cmd[1])) {
			$left = del_chan($fp, $line['nick'], $cmd[1]);
			if ($left) {
				cpart($fp, $cmd[1]);
			} else {
				fwrite($fp, "NOTICE " . $line['nick'] . " :Channel {$channel} is unkown.\r\n");
			}
		} else {
			fwrite($fp, "NOTICE " . $line['nick'] . " :You are not a channel operator.\r\n");
		}

	}
}
?>
