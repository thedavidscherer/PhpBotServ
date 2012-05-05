<?php
$stmt = "SELECT id FROM `channels` WHERE `channel`=?";
$db->storeStatement('addword_checkchannel', $stmt);
$stmt = "SELECT * FROM `badwords` WHERE `chan_id`=? AND `word`=?";
$db->storeStatement('addword_checkword', $stmt);
$stmt = "INSERT INTO `badwords` VALUES ('', ?,?)";
$db->storeStatement('addword_storeword', $stmt);

//TODO clean up statement resetting here
function addword ($fp, $word, $channel) {
	global $db;
	$stmt = $db->getStatement('addword_checkchannel');
    
  try {
    $stmt->bind_param('s', $channel);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id);
    $stmt->fetch();
  
    $stmt2 = $db->getStatement('addword_checkword');
    $stmt2->bind_param('is', $id, $word);
    $stmt2->execute();
    $stmt2->store_result();
    if ($stmt2->num_rows < 1) {
      
      $stmt3 = $db->getStatement('addword_storeword');
      $stmt3->bind_param('si', $word, $id);
      $stmt3->execute();
      
      $stmt->reset();
      $stmt2->reset();
      $stmt3->reset();
      return true;
    }
    else {
      $stmt->reset();
      $stmt2->reset();
      return false;
    }
  }
  catch (Exception $e) {
    fwrite ($fp, "NOTICE ". $nick . " :Failed to update Database. Try again.\r\n");
    if(isset($stmt))
    	$stmt->reset();
    if(isset($stmt2))
    	$stmt2->reset();
    if(isset($stmt3))
    	$stmt3->reset();
    return false;
  }

}

?>
