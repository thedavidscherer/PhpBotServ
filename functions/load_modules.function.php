<?php
function load_modules($directory) {
	$modules = array();

    $dir = opendir($directory);
    while ($file = readdir($dir)) {
        if ($file != '.' && $file != '..' && preg_match("/.+\.php/", $file)) {
        	//we load a module from the file
        	echo "loading: ".$file."\r\n";
        	$curmod = null;
        	include($directory.'/'.$file);
        	$curmod = new $classname; //IT WORKS!!! MUAHAHAAAAA
        	$modules[] = $curmod;
        }
    }
    closedir($dir);
    return $modules;
}
?>
