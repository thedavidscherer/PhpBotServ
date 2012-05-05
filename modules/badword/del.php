<?php
$classname = 'Del';
class Del {
	function getCommand() {
		return 'del';
	}
	function processCommand($fp, $line, $cmd) {
		if (getPerm($fp, $line['nick'], $cmd[1])) {
			$deleted = delword($fp, $cmd[3], $cmd[1]);
			if ($deleted) {
				fwrite($fp, "NOTICE {$line['nick']} :{$cmd[3]} deleted from {$cmd[1]}'s badword list.\r\n");
			} else {
				fwrite($fp, "NOTICE {$line['nick']} :{$cmd[3]} not found in {$cmd[1]}'s badword list.\r\n");
			}
		} else {
			fwrite($fp, "NOTICE " . $line['nick'] . " :You are not a channel operator.\r\n");
		}
	}
}
?>
