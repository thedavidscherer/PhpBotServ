<?php
$classname = 'ListCommand';
class ListCommand { //PHP whines about just 'List' for some reason
	function getCommand() {
		return 'list';
	}
	function processCommand($fp, $line, $cmd) {
		if (getPerm($fp, $line['nick'], $cmd[1])) {
			listwords($fp, $line['nick'], $cmd[1]);
		} else {
			fwrite($fp, "NOTICE " . $line['nick'] . " :You are not a channel operator.\r\n");
		}
	}
}
?>
