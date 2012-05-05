<?php

/*
PHP BotServ
VERSION: 2.0.0 Public Beta
*/
$debug = true;
/*
Includes
***********************/
//first the text processing functions
include './functions/get_option.function.php';
include './functions/get_line.function.php';
include './functions/ping.function.php';
include './functions/parse_cmd.function.php';
include './functions/parse_line.function.php';
include './functions/cjoin.function.php';
include './functions/cpart.function.php';
include './functions/getPerm.function.php';
include './functions/help.function.php';
include './functions/load_modules.function.php';

//now we initialize the database
include './db.php';
$db = new DB();
if(!$db->isConnected()) {
	echo "Failed to connect to the database!\n";
	return;
}

//then the database functions
include './functions/add_chan.function.php';
include './functions/del_chan.function.php';
include './functions/addword.function.php';
include './functions/delword.function.php';
include './functions/listwords.function.php';
include './functions/checkword.function.php';
include './functions/rejoin.function.php';
include './functions/infraction.function.php';


/*
Load Modules
***********************/
echo "Loading Modules...\n";
$modules = load_modules("modules");
echo "Modules Loaded:\n";
foreach ($modules as $mod) {
	echo $mod->getName() . "\n";
}
echo "Caching Modules...\n";
$globalmodules = array ();
foreach ($modules as $mod) {
	if ($mod->handlesGlobalMessages()) {
		$globalmodules[] = $mod;
	}
}
$directmodules = array ();
foreach ($modules as $mod) {
	if ($mod->handlesDirectCommands()) {
		$directmodules[$mod->getCommand()] = $mod;
	}
}
echo "Module Processing Complete!\n";
/*
Connection
***********************/

$host = get_option('network', 'server_addr');
$port = get_option('network', 'server_port');
$nick = get_option('network', 'server_nick'); //TODO should this be made lowercase?
$oper = get_option('network', 'server_oper');
$pass = get_option('network', 'server_pass');
$ident = get_option('network', 'server_ident');
$realname = get_option('network', 'server_real');
$email = get_option('network', 'server_email');

//make connection
$fp = fsockopen($host, $port, $errno, $errstr, 30);

//login
fwrite($fp, "NICK " . $nick . "\r\n");
fwrite($fp, "USER " . $ident . " " . $host . " bla :" . $realname . "\r\n");
fwrite($fp, "PRIVMSG NickServ :IDENTIFY " . $pass . "\r\n");
fwrite($fp, "OPER {$oper} {$pass}\r\n");

//version
fwrite($fp, "PRIVMSG #opers :PHP BotServ VERSION: 2.0.0 Public Beta\r\n");

//rejoin added channels
rejoin($fp);

/*
Main Program
***********************/

while (!feof($fp)) {
$
	$line = get_line($fp);

	ping($fp, $line);

	fwrite($fp, "PRIVMSG #RomLog :{$line}\r\n");
	$line = strtolower($line);

	$line = parse_line($line);
	//fwrite($fp, "PRIVMSG #RomLog :{$line['to']}\r\n");
	if ($line['type'] == 'privmsg') {
		if (strtolower($line['to']) == strtolower($nick)) {
			//we have a direct command
			$cmd = parse_cmd($line['full']);
			echo "command: ";
			Print_r($cmd);
			if (isset ($directmodules[$cmd[0]])) {
				echo "Calling module: ".$directmodules[$cmd[0]]->getName()."\n";
				$directmodules[$cmd[0]]->processCommand($fp, $line, $cmd);
			} else {
				fwrite($fp, "NOTICE " . $line['nick'] . " :Unknown command " . $cmd[0] . " /msg " . get_option('network', 'server_nick') . " HELP for help.\r\n");
			}
		} else {
			//we have a regular chat message
			foreach ($globalmodules as $mod) {
				$mod->processGlobalMessage($fp, $line);
			}
		}

	}

}
?>
