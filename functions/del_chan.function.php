<?php
$stmt = "SELECT id FROM `channels` WHERE `channel`=?";
$db->storeStatement('del_chan_checkchannel', $stmt);
$stmt = "DELETE FROM `channels` WHERE `channel`=?";
$db->storeStatement('del_chan_deletechannel', $stmt);
$stmt = "DELETE FROM `badwords` WHERE `chan_id`=?";
$db->storeStatement('del_chan_deletebadwords', $stmt);
$stmt = "DELETE FROM `offenders` WHERE `channel`=?";
$db->storeStatement('del_chan_deleteoffenders', $stmt);


function del_chan ($fp, $nick, $channel) {
    global $db;
    try {
      $stmt = $db->getStatement('del_chan_checkchannel');
      $stmt->bind_param('s', $channel);
      $stmt->execute();
      $stmt->store_result();
      if ($stmt->num_rows >= 1) {
        $stmt->bind_result($id);
        $stmt->fetch();
        $stmt->reset();
        
        $stmt = $db->getStatement('del_chan_deletechannel');
        $stmt->bind_param('s', $channel);
        $stmt->execute();
        $stmt->reset();
        
        $stmt = $db->getStatement('del_chan_deletebadwords');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->reset();
        
		$stmt = $db->getStatement('del_chan_deleteoffenders');
		$stmt->bind_param('s', $channel);
		$stmt->execute();
		$stmt->reset();                
        return true;
      }
      else{
        $stmt->reset();
        return false;
      }
    }
    catch (Exception $e) {
      fwrite ($fp, "NOTICE ". $nick . " :Failed to update Database. Try again.\r\n");
      $stmt->reset();
      return false;
    }

}

?>
