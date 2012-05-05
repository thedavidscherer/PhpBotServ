<?php
$stmt = "SELECT id FROM `channels` WHERE `channel`=?";
$db->storeStatement('delword_checkchannel', $stmt);
$stmt = "SELECT * FROM `badwords` WHERE `chan_id`=? AND `word`=?";
$db->storeStatement('delword_checkword', $stmt);
$stmt = "DELETE FROM `badwords` WHERE `word`=? AND `chan_id`=?";
$db->storeStatement('delword_deleteword', $stmt);

function delword ($fp, $word, $channel) {
	global $db;
    
  try {
  	$stmt = $db->getStatement('delword_checkchannel');
  	$stmt->bind_param('s', $channel);
  	$stmt->execute();
  	$stmt->store_result();
  	$stmt->bind_result($id);
  	$stmt->fetch();
  	$stmt->reset();
  
  	$stmt = $db->getStatement('delword_checkword');
  	$stmt->bind_param('is', $id, $word);
  	$stmt->execute();
  	$stmt->store_result();
    if ($stmt->num_rows >= 1) {
      $stmt->reset();
      
      $stmt = $db->getStatement('delword_deleteword');
      $stmt->bind_param('si', $word, $id);
      $stmt->execute();
      $stmt->reset();
      return true;
    }
    else {
      $stmt->reset();
      return false;
    }
  }
  catch (Exception $e) {
    fwrite ($fp, "NOTICE ". $nick . " :Failed to update Database. Try again.\r\n");
    if(isset($stmt))
    	$stmt->reset();
    return false;
  }

}

?>
<?php

?>
