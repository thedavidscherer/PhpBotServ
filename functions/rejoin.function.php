<?php
$stmt = "SELECT channel FROM `channels`";
$db->storeStatement('rejoin_getchannels', $stmt);

function rejoin($fp) {
	global $db;

	try {

		$stmt = $db->getStatement('rejoin_getchannels');
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($channel);
		while ($stmt->fetch()) {
			cjoin($fp, $channel);
		}
		$stmt->reset();
		return true;
	} catch (Exception $e) {
		fwrite($fp, "NOTICE " . $nick . " :Failed to update Database. Try again.\r\n");
		if (isset ($stmt))
			$stmt->reset();
		return false;
	}

}
?>
