<?php
$classname = 'Add';
class Add {
	function getCommand() {
		return 'add';
	}
	function processCommand($fp, $line, $cmd) {
		if (getPerm($fp, $line['nick'], $cmd[1])) {
			$added = addword($fp, $cmd[3], $cmd[1]);
			if ($added) {
				fwrite($fp, "NOTICE {$line['nick']} :{$cmd[3]} added to {$cmd[1]}'s badword list.\r\n");
			} else {
				fwrite($fp, "NOTICE {$line['nick']} :{$cmd[3]} already exists in {$cmd[1]}'s badword list.\r\n");
			}
		} else {
			fwrite($fp, "NOTICE " . $line['nick'] . " :You are not a channel operator.\r\n");
		}
	}
}
?>
