<?php

function cpart ($fp, $channel){

  fwrite ($fp, "PART :{$channel}\r\n");

}

?>
