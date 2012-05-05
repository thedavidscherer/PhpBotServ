<?php

function parse_line ($string) {

  $str_parts = array (
  'nick'  => '',
  'host'  => '',
  'type'  => '',
  'to'    => '',
  'cmd'   => '',
  'txt'   => '',
  'full'  => ''
  );
  
  /*TEST STRING:
  :David!david@IRCAdmin.x10hosting.com PRIVMSG #vhost :!help text
  ****************************/

  //explode $string at spaces for global use
  $string2             = explode (" ", $string);
  
  //explode $string[0] at ! for nick and host
  if (!empty($string2[0])) {
  
    $temp               = explode ("!", $string2[0]);
    
  }
  
  //nick
  if (!empty($temp[0])) {
  
  $str_parts['nick']  = trim ($temp[0], ":");
  
  }
  
  //host
  if (!empty($temp[1])) {
  
  $str_parts['host']  = $temp[1];
  
  }
  
  //type
  if (!empty($string2[1])) {
      
  $str_parts['type']  = $string2[1];
  
  }
  
  //to
  if (!empty($string2[2])) {
  
    $str_parts['to']    = $string2[2];
  
  }
  
  //cmd
  if (!empty($string2[3])) {
  
    $str_parts['cmd']   = trim($string2[3], ":");
  
  }
  
  //txt
  if (!empty($string2[3])) {
  
    $str_parts['txt']   = $string2[4];
  
  }
    
    $string2            = explode (":", $string);
  
  //full
  if (!empty($string2[2])) {
  
    $str_parts['full']  = $string2[2];
  
  }
  
  return $str_parts;

} 

?>
