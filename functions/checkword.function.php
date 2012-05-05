<?php

function checkword ($Uword, $channel) {

  try {
    $conn = mysql_connect(get_option('mysql', 'mysql_server'), get_option('mysql', 'mysql_user'), get_option('mysql', 'mysql_pass'));
    mysql_select_db(get_option('mysql', 'mysql_db'));
  }
  catch (Exception $e) {
    fwrite ($fp, "NOTICE ". $nick . " :Failed to make Database connection. Try again.\r\n");
  }
  
  $query  = "SELECT * FROM `channels` WHERE `channel`='{$channel}'";
  $result = mysql_query ($query) or die (mysql_error());
  $items  = mysql_fetch_array($result);
  
  $query  = "SELECT * FROM `badwords` WHERE `chan_id`='{$items['id']}'";
  $result = mysql_query($query);
  
  while ($Blist  = mysql_fetch_array($result)) {
    
    $Bword  = strtolower ($Blist['word']);
    $Uword  = strtolower ($Uword);
    
    if (strpos ($Uword, $Bword) === false) {
      continue;
    }
    else {
<<<<<<< HEAD
      if ( (strlen($Bword) == strlen($Uword)) || ((strlen($Bword) + 3) == strlen($Uword)) ) {
      	return true;
      }
      else {
        continue;
      }
=======
    	return true;
>>>>>>> 0202d48031c464aaeebe1455ac4a099ad8e31550
    }
  
  }
  
  return false;

}

?>
