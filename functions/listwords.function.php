<?php
$stmt = "SELECT id FROM `channels` WHERE `channel`=?";
$db->storeStatement('listwords_getchannel', $stmt);
$stmt = "SELECT word FROM `badwords` WHERE `chan_id`=?";
$db->storeStatement('listwords_getbadwords', $stmt);

function listwords($fp, $nick, $channel) {
	global $db;
	
	$stmt = $db->getStatement('listwords_getchannel');
	$stmt->bind_param('s', $channel);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($id);
	$stmt->fetch();
	$stmt->reset();
	
	$stmt = $db->getStatement('listwords_getbadwords');
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($word);
	while ($stmt->fetch()) {

		fwrite($fp, "NOTICE {$nick} :{$word}\r\n");

	}
	$stmt->reset();

}
?>
