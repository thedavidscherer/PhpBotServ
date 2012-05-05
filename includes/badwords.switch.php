<?php

switch ($cmd[2]) {

  case 'add': {
  
    if (getPerm ($fp, $line['nick'], $cmd[1])) {
    
      $added = addword ($fp, $cmd[3], $cmd[1]);
      
      if ($added) {
      
        fwrite ($fp, "NOTICE {$line['nick']} :{$cmd[3]} added to {$cmd[1]}'s badword list.\r\n");
      
      }
      else {
      
        fwrite ($fp, "NOTICE {$line['nick']} :{$cmd[3]} already exists in {$cmd[1]}'s badword list.\r\n");
      
      }
    
    }
    else {
      fwrite ($fp, "NOTICE ". $line['nick'] . " :You are not a channel operator.\r\n");    
    }
  
    break;
  }
  case 'del': {
  
    if (getPerm ($fp, $line['nick'], $cmd[1])) {
    
      $deleted = delword ($fp, $cmd[3], $cmd[1]);
      
      if ($deleted) {
      
        fwrite ($fp, "NOTICE {$line['nick']} :{$cmd[3]} deleted from {$cmd[1]}'s badword list.\r\n");
      
      }
      else {
      
        fwrite ($fp, "NOTICE {$line['nick']} :{$cmd[3]} not found in {$cmd[1]}'s badword list.\r\n");
      
      }
    
    }
    else {
      fwrite ($fp, "NOTICE ". $line['nick'] . " :You are not a channel operator.\r\n");    
    }
    
    break;
  }
  case 'list': {
  
    if (getPerm ($fp, $line['nick'], $cmd[1])) {
    
      listwords ($fp, $line['nick'], $cmd[1]);
    
    }
    else {
      fwrite ($fp, "NOTICE ". $line['nick'] . " :You are not a channel operator.\r\n");    
    }
  
    break;
  }
  default: {
  
    fwrite ($fp, "NOTICE ". $line['nick'] . " :Unknown command " . $cmd[2] .  " /msg " . get_option('network','server_nick') . " HELP BADWORDS for help.\r\n");
    break;
  
  }
  
}

?>
