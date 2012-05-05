<?php

function getPerm ($fp, $nick, $channel) {

  fwrite ($fp, "WHO +cn {$channel} {$nick}\r\n");
  $line = get_line ($fp);
  
  //:irc.x10hosting.com 352 Romulus #x10hosting david NetAdmin.x10hosting.com irc.x10hosting.com David Hr*?& :0 David Scherer

  $temp = explode(" ", $line);
  
  $line = $temp[8];
  
  $reg = false;
  $opr = false;
  $cop = false;
  
  for ($i = 0; $i <= strlen ($line); $i++) {
  
    switch ($line[$i]) {
    
      case "r": {
        $reg = true;
        break;
      }
      case "*": {
        $opr = true;
        break;
      }
      case "~": {
        $cop = true;
        break;
      }
      case "&": {
        $cop = true;
        break;
      }
      case "@": {
        $cop = true;
        break;
      }
    
    }
  
  }
  
  if (($reg === true) && (($opr === true) || ($cop === true))) {
    return true;
  }
  else {
    return false;
  }
  
}

?>
