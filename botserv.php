<?php
/*
PHP BotServ
VERSION: 0.1.1 Public Beta
*/

/*
Includes
***********************/
include './functions/get_option.function.php';
include './functions/ping.function.php';
include './functions/get_line.function.php';
include './functions/parse_cmd.function.php';
include './functions/parse_line.function.php';
include './functions/add_chan.function.php';
include './functions/del_chan.function.php';
include './functions/cjoin.function.php';
include './functions/cpart.function.php';
include './functions/getPerm.function.php';
include './functions/addword.function.php';
include './functions/delword.function.php';
include './functions/listwords.function.php';
include './functions/checkword.function.php';
include './functions/rejoin.function.php';
include './functions/help.function.php';
include './functions/infraction.function.php';

/*
Connection
***********************/

$host       = get_option ('network', 'server_addr');
$port       = get_option ('network', 'server_port');
$nick       = get_option ('network', 'server_nick');
$oper       = get_option ('network', 'server_oper');
$pass       = get_option ('network', 'server_pass');
$ident      = get_option ('network', 'server_ident');
$realname   = get_option ('network', 'server_real');
$email      = get_option ('network', 'server_email');

//make connection
$fp         = fsockopen ($host, $port, $errno, $errstr, 30);

//login
fwrite($fp, "NICK ".$nick."\r\n");
fwrite($fp, "USER ".$ident." ".$host." bla :".$realname."\r\n");
fwrite($fp, "PRIVMSG NickServ :IDENTIFY ".$pass."\r\n");
fwrite($fp, "OPER {$oper} {$pass}\r\n");

//version
fwrite ($fp, "PRIVMSG #opers :PHP BotServ VERSION: 0.1.1 Public Beta\r\n");
    
//rejoin added channels
rejoin ($fp);

/*
Main Program
***********************/

while (!feof($fp)) {

  $line   = get_line ($fp);
  
  ping ($fp, $line);
  
  $line = strtolower($line);
  
  $line = parse_line ($line);
  
  fwrite ($fp, "PRIVMSG #RomLog :{$line}\r\n");
  
  switch ($line['type']) {
  
    case 'privmsg': {
    
      echo "Case: PRIVMSG active.\n";
      include './includes/privmsg.switch.php';
      
      break;
    
    }
  
  }

}

?>
