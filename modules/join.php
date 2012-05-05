<?php
$classname = 'Join';
class Join {
	function getName() {
		return "Join";
	}
	function getCommand() {
		return "join";
	}
	function handlesDirectCommands() {
		return true;
	}
	function handlesGlobalMessages() {
		return false;
	}
	function processCommand($fp, $line, $cmd) {
		echo "Case join active\n";
		if (getPerm($fp, $line['nick'], $cmd[1])) {
			$joined = add_chan($fp, $line['nick'], $cmd[1]);
			if ($joined) {
				cjoin($fp, $cmd[1]);
			} else {
				fwrite($fp, "NOTICE " . $line['nick'] . " :Channel {$channel} is already moderated.\r\n");
			}
		} else {
			fwrite($fp, "NOTICE " . $line['nick'] . " :You are not a channel operator.\r\n");
		}
	}
}
?>
