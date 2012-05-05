<?php

function rejoin ($fp) {

  try {
      $conn = mysql_connect(get_option('mysql', 'mysql_server'), get_option('mysql', 'mysql_user'), get_option('mysql', 'mysql_pass'));
      mysql_select_db(get_option('mysql', 'mysql_db'));
    }
    catch (Exception $e) {
      fwrite ($fp, "NOTICE #opers :Failed to make Database connection. Try again.\r\n");
    }
    
    try {
      
      $query  = "SELECT * FROM `channels`";
      $result = mysql_query ($query) or die ("\nMySQL Error:\n" . mysql_error() . "\n\n");
      
      while ($chan = mysql_fetch_array ($result)) {
      
        cjoin ($fp, $chan['channel']);
      
      }
      
    }
    catch (Exception $e) {
      fwrite ($fp, "NOTICE ". $nick . " :Failed to update Database. Try again.\r\n");
      mysql_close($conn);
      return false;
    }

}

?>
