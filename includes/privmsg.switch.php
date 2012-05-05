<?php

$nick = strtolower($nick);

switch ($line['to']) {

  case $nick: {
  
    echo "Case $nick active\n";
    include 'cmds.switch.php';
      
    break;
  
  }
  
  default: {
  
    echo "Case default active\n";
    $words  = parse_cmd ($line['full']);
    
    foreach ($words as $word) {
    
      $exists = checkword ($word, $line['to']);
      
      if ($exists === true) {
        
        $ban = infraction ($line['to'], $line['nick']);
        
        if ($ban === true) {
        
          fwrite ($fp, "MODE {$line['to']} +b *!{$line['host']}\r\n");
          echo "MODE {$line['to']} +b *!{$line['host']}\r\n";
          fwrite ($fp, "KICK {$line['to']} {$line['nick']} :You swore greater than 5 times. You'll have to wait 'till some kind person does the dirty deed of unbanning you. In the mean time, get some soap and clean your mouth!\r\n");
        
        }
        else {
        
          fwrite ($fp, "KICK {$line['to']} {$line['nick']} :Mind your tongue!\r\n");
        
        }
        
      }
    
    }
    
    break;
  
  }

}

?>
