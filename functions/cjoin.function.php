<?php

function cjoin ($fp, $chan) {

  fwrite ($fp, "JOIN :{$chan}\r\n");

}

?>
