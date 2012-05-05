<?php

/*
Author: Andrew Wiley
Date: 07.11.09
Change(s): Full re-write 
*/

//some general questions with answers that will help:
// what are nonletters that can be used to represent letters (eg @ can be a)?
// what are common ways of hiding curse words?
function checkword($text, $Bword) {
	//this is the typed statement
	$text = strtolower($text);

	//this helps to avoid some common workarounds
	$expressions = array (
		'@',
		'$',
		'3',
		'1',
		'7'
	);
	$replacements = array (
		'a',
		's',
		'e',
		'l',
		't'
	); //make sure these are lowercase
	$text = str_replace($expressions, $replacements, $text);
	//this gets the typed statement with spaces and punctuation removed
	$textcut = preg_replace('/[^a-z]/', '', $text);

	if (strpos($textcut, $Bword) === false) {
		//the word wasn't there at all
		return false;
	} else {
		//get an array of all the words typed
		$textarr = preg_split('/ +/', $text);
		//this regex will check for a repeated last letter (eg assss)
		$regex = '/' . $Bword . '+/';
		foreach ($textarr as $word) {
			//we delete the entire matching phrase and see if that's the whole word
			if ($word == $Bword || preg_replace('/[^a-z]/', '', $word) == $Bword || preg_replace($regex, '', $text) == "") {
				//echo "first<br>";
				return true;
			}

		}
		//NOTE: this is probably the most processor-intensive part
		//it's not a word by itself, has it been split? (eg "a s s")
		//NOTE: this approach will NOT pick up "a ss"
		$index = 0;
		$regex = "/";
		$length = strlen($Bword) - 1; //we skip the last character
		while ($index < $length) {
			$regex .= $Bword[$index] . ' +';
			$index++;
		}
		$regex .= $Bword[$length] . '/'; //no regex after the last element
		//so at this point we should have something that looks like
		// '/a +s +s/'
		if (preg_match($regex, $text)) {
			//echo "third<br>";
			return true;
		}
	}
	return false;
}
?>
<html>
<body>
<form action="checkword.php" method="get">
<input type=text name="word" 
<?php


if (isset ($_GET['word'])) {
	echo 'value="' . $_GET['word'] . '"';
}
?>
>
<input type=submit>
</form><br>
<?php

if (isset ($_GET['word'])) {
	if (checkword($_GET['word'], 'ass')) {
		echo "found it";
	} else {
		echo "didn't find it";
	}
}
?>