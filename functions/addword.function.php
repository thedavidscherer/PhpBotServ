<?php

function addword ($fp, $word, $channel) {

  try {
    $conn = mysql_connect(get_option('mysql', 'mysql_server'), get_option('mysql', 'mysql_user'), get_option('mysql', 'mysql_pass'));
    mysql_select_db(get_option('mysql', 'mysql_db'));
  }
  catch (Exception $e) {
    fwrite ($fp, "NOTICE ". $nick . " :Failed to make Database connection. Try again.\r\n");
  }
    
  try {
  
    $query  = "SELECT * FROM `channels` WHERE `channel`='{$channel}'";
    $result = mysql_query ($query) or die (mysql_error());
      
    $items = mysql_fetch_array ($result);
  
    $query  = "SELECT * FROM `badwords` WHERE `chan_id`='{$items['id']}' AND `word`='{$word}'";
    $result = mysql_query ($query) or die(mysql_error());
    
    if (mysql_num_rows($result) < 1) {
      
      $query  = "INSERT INTO `badwords` VALUES ('', '{$word}','{$items['id']}')";
      $result = mysql_query ($query) or die(mysql_query());
      
      mysql_close($conn);
      return true;
    }
    else {
      mysql_close($conn);
      return false;
    }
  }
  catch (Exception $e) {
    fwrite ($fp, "NOTICE ". $nick . " :Failed to update Database. Try again.\r\n");
    mysql_close($conn);
    return false;
  }

}

?>
