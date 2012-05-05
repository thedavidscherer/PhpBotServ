<?php

function listwords ($fp, $nick, $channel) {

  try {
    $conn = mysql_connect(get_option('mysql', 'mysql_server'), get_option('mysql', 'mysql_user'), get_option('mysql', 'mysql_pass'));
    mysql_select_db(get_option('mysql', 'mysql_db'));
  }
  catch (Exception $e) {
    fwrite ($fp, "NOTICE ". $nick . " :Failed to make Database connection. Try again.\r\n");
  }

  $query  = "SELECT * FROM `channels` WHERE `channel`='{$channel}'";
  $result = mysql_query ($query);
  $items  = mysql_fetch_array($result);
  
  $query  = "SELECT * FROM `badwords` WHERE `chan_id`='{$items['id']}'";
  $result = mysql_query($query);
  
  while ($words  = mysql_fetch_array($result)) {
    
    fwrite ($fp, "NOTICE {$nick} :{$words['word']}\r\n");
  
  }

}

?>
