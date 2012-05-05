<?php

  function help ($fp, $file, $nick) {
  
    $hf     = fopen ($file, r);
    
    $farray = file ($file);
    $lines  = count ($farray);
    
    for ($x = 0; $x < $lines; $x++) {
    
      $hline = fgets ($hf);
      
      $hline = str_replace ("{BOT}", get_option ('network', 'server_nick'), $hline);
      $hline = str_replace ("{B}", chr(2), $hline);
      $hline = str_replace ("{U}", chr(31), $hline);
      $hline = str_replace ("{BR}", "\r\n", $hline);
      $hline = str_replace ("{T}", "\t", $hline);
      
      echo $hline;
      fwrite ($fp, "NOTICE {$nick} :{$hline}");
      
    
    }
  
  }

?>
