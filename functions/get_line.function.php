<?php

function get_line ($fp, $echo=NULL) {

  if (empty($echo)){
    
    $echo = true;
  
  }
  
  $line =   fgets($fp);
  $line =   trim($line);
  
  if ($echo === true) { 
  
    echo "[" . date("H:i:s") . "]\t" . $line . "\n";
    
  }
  
  return $line;

}

?>
