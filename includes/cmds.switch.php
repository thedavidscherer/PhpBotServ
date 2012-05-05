<?php

$cmd  = parse_cmd ($line['full']);

$result = "";
$conn   = "";

switch ($cmd[0]) {

  case 'join':{
  
    echo "Case join active\n";
      
    if (getPerm ($fp, $line['nick'], $cmd[1])) {  
      
      $joined = add_chan($fp, $line['nick'], $cmd[1]);
      
      if($joined) {
        cjoin ($fp, $cmd[1]);    
      }
      else {
        fwrite ($fp, "NOTICE ". $line['nick'] . " :Channel {$channel} is already moderated.\r\n");
      }
    }
    else {
      fwrite ($fp, "NOTICE ". $line['nick'] . " :You are not a channel operator.\r\n");
    }
    
    break;
  }
  
  case 'part': {
  
    echo "Case part active\n";
    if (getPerm ($fp, $line['nick'], $cmd[1])) {  
      $left = del_chan ($fp, $line['nick'], $cmd[1]);
      
      if ($left) {
        cpart($fp, $cmd[1]);
      }
      else {
        fwrite ($fp, "NOTICE ". $line['nick'] . " :Channel {$channel} is unkown.\r\n");
      }
    }
    else {
      fwrite ($fp, "NOTICE ". $line['nick'] . " :You are not a channel operator.\r\n");
    }
  
    break;
  }
  
  case 'badwords': {
  
    echo "Case bawords active\n";
    include 'badwords.switch.php';
    
    break;
  
  }
  
  case "help": {
  
    echo "Case help active\n";
    
    if (isset ($cmd[1])){
      include 'help.switch.php';
    }
    else {
      $file = "/home/bots/botserv/help/default.help";
      help ($fp, $file, $line['nick']);
    }
    
    break;
  
  }
  
  default: {
  
    fwrite ($fp, "NOTICE ". $line['nick'] . " :Unknown command " . $cmd[0] .  " /msg " . get_option('network','server_nick') . " HELP for help.\r\n");
  
  }
}

?>
