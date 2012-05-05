<?php

function ping ($fp, $line) {

  if ($line == "PING :irc.x10hosting.com") {
      
      fwrite($fp, "PONG :irc.x10hosting.com\r\n");
      
  }

}

?>
