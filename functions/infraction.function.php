<?php
$stmt = "SELECT id,count FROM `offenders` WHERE `channel`=? AND `nick`=?";
$db->storeStatement('infraction_checkoffender', $stmt);
$stmt = "UPDATE `offenders` SET `count`='0' WHERE `id`=?";
$db->storeStatement('infraction_resetoffender', $stmt);
$stmt = "UPDATE `offenders` SET `count`=? WHERE `id`=?";
$db->storeStatement('infraction_incrementoffender', $stmt);
$stmt = "INSERT INTO `offenders` VALUES ('',?,'1',?)";
$db->storeStatement('infraction_addoffender', $stmt);

function infraction($channel, $nick) {
	global $db;

	$stmt = $db->getStatement('infraction_checkoffender');
	$stmt->bind_param('ss', $channel, $nick);
	$stmt->execute();
	$stmt->store_result();

	if ($stmt->num_rows == 1) {

		echo "THERE WAS A ROW!";

		$stmt->bind_result($id, $count);
		$stmt->fetch();
		$stmt->reset();

		if ($count >= 5) {

			echo "COUNT IS >= TO 5";
			$stmt = $db->getStatement('infraction_resetoffender');
			$stmt->bind_param('i', $id);
			$stmt->execute();
			$stmt->reset();
			return true;

		} else {

			echo "COUNT NOT >= 5, INCREMENTING COUNT";

			$count = $count +1;

			$stmt = $db->getStatement('infraction_incrementoffender');
			$stmt->bind_param('ii', $count, $id);
			$stmt->execute();
			$stmt->reset();
			return false;

		}

	} else {

		echo "USER DOESN'T EXIST, ADDING RECORD";

		$stmt = $db->getStatement('infraction_addoffender');
		$stmt->bind_param('ss', $channel, $nick);
		$stmt->execute();
		$stmt->reset();
		return false;

	}

}
?>
