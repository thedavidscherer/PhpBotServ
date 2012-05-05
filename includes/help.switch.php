<?php

switch ($cmd['1']) {

  case "badwords": {
  
    $file = '/home/bots/botserv/help/badwords.help';
    help ($fp, $file, $line['nick']);
    
    break;
  
  }
  
  case "join": {
  
    $file = '/home/bots/botserv/help/join.help';
    help ($fp, $file, $line['nick']);
    
    break;
  
  }
  
  case "part": {
  
    $file = '/home/bots/botserv/help/part.help';
    help ($fp, $file, $line['nick']);
    
    break;
  
  }
  
  default: {
  
    fwrite ($fp, "NOTICE {$line['nick']} :No help available for " . chr(2) . "{$cmd[1]}" . chr(2));
    
    break;
  
  }

}

?>
