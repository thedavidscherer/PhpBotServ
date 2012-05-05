<?php
function get_option($section, $option) {
	$ini_contents = parse_ini_file("./config.ini", true);
	return $ini_contents[$section][$option];

}
?>
