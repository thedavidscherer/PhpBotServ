<?php
$classname = 'BadWord';
class BadWord {
	private $modules;
	//we can have a constructor as long as there are no arguments
	function __construct() {
		//we're running at the root of the bot,
		//so the submodules of this module are in modules/badword/*.php
		$tmp = load_modules('modules/badword');
		$this->modules = array ();
		//with submodules, we make our own rules
		foreach ($tmp as $mod) {
			$this->modules[$mod->getCommand()] = $mod;
		}
	}
	function getName() {
		return 'BadWord';
	}
	function handlesDirectCommands() {
		return true;
	}
	function getCommand() {
		return 'badwords';
	}
	function handlesGlobalMessages() {
		return true;
	}
	function processCommand($fp, $line, $cmd) {
		if(isset($this->modules[$cmd[2]])) {
			$this->modules[$cmd[2]]->processCommand($fp, $line, $cmd);
		}
		else {
			fwrite ($fp, "NOTICE ". $line['nick'] . " :Unknown command " . $cmd[2] .  " /msg " . get_option('network','server_nick') . " HELP BADWORDS for help.\r\n");
		}
	}
	function processGlobalMessage($fp, $line) {
		$words = parse_cmd($line['full']);
		foreach ($words as $word) {
			$exists = checkword($word, $line['to']);
			if ($exists === true) {
				$ban = infraction($line['to'], $line['nick']);
				if ($ban === true) {
					fwrite($fp, "MODE {$line['to']} +b *!{$line['host']}\r\n");
					echo "MODE {$line['to']} +b *!{$line['host']}\r\n";
					fwrite($fp, "KICK {$line['to']} {$line['nick']} :You swore greater than 5 times. You'll have to wait 'till some kind person does the dirty deed of unbanning you. In the mean time, get some soap and clean your mouth!\r\n");
				} else {
					fwrite($fp, "KICK {$line['to']} {$line['nick']} :Mind your tongue!\r\n");
				}
			}
		}
	}
}
?>
