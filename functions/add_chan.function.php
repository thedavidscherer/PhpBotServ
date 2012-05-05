<?php
$stmt = "SELECT * FROM `channels` WHERE `channel`=?";
$db->storeStatement('add_chan_stmt_select', $stmt);
$stmt = "INSERT INTO `channels` VALUES ('',?)";
$db->storeStatement('add_chan_stmt_insert', $stmt);
//now they're stored; we can pull them out whenever we need it

//TODO clean up statement resetting here
function add_chan($fp, $nick, $channel) {
	global $db;
	try {
		$stmt = $db->getStatement('add_chan_stmt_select');
		$stmt->bind_param('s',$channel);
		if (!$stmt->execute()) {
			$db->ping();
			if (!$stmt->execute()) {
				fwrite($fp, "NOTICE " . $nick . " :Failed to make Database connection. Try again.\r\n");
				$stmt->reset();
				return false;
			}
		}
		$stmt->store_result();
		if ($stmt->num_rows < 1) {
			$stmt2 = $db->getStatement('add_chan_stmt_insert');
			$stmt->bind_param('s',$channel);
			$stmt2->execute();
			$stmt2->reset();
			$stmt->reset();
			return true;
		} else {
			$stmt->reset();
			return false;
		}
	} catch (Exception $e) {
		fwrite($fp, "NOTICE " . $nick . " :Failed to update Database. Try again.\r\n");
		if(isset($stmt)) {
			$stmt->reset();
		}
		if(isset($stmt2)) {
			$stmt2->reset();
		}
		return false;
	}

}
?>
