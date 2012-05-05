<?php
function infraction ($channel, $nick) {

  try {
    $conn = mysql_connect(get_option('mysql', 'mysql_server'), get_option('mysql', 'mysql_user'), get_option('mysql', 'mysql_pass'));
    mysql_select_db(get_option('mysql', 'mysql_db'));
  }
  catch (Exception $e) {
    fwrite ($fp, "NOTICE ". $nick . " :Failed to make Database connection. Try again.\r\n");
  }
  
  $query  = "SELECT * FROM `offenders` WHERE `channel`='{$channel}' AND `nick`='{$nick}'";
  $result = mysql_query ($query);
  
  if (mysql_num_rows ($result) == 1) {
  
    echo "THERE WAS A ROW!";
  
    $items = mysql_fetch_array ($result);
    
    if ($items['count'] >= 5) {
    
      echo "COUN IS >= TO 5";
      
      $query  = "UPDATE `offenders` SET `count`='0' WHERE `id`='{$items['id']}'";
      $result = mysql_query ($query);
      
      return true;
    
    }
    else {
    
      echo "COUNT NOT >= 5, INCREMENTING COUNT";
    
      $count = $items['count'] + 1;
      
      $query  = "UPDATE `offenders` SET `count`='{$count}' WHERE `id`='{$items['id']}'";
      $result = mysql_query ($query);
      
      return false;
    
    }
  
  }
  else {
  
    echo "USER DOESN'T EXIST, ADDING RECORD";
    
    $query  = "INSERT INTO `offenders` VALUES ('','{$channel}','1','{$nick}')";
    $result = mysql_query ($query);
    
    return false;
    
  }
  
}

?>