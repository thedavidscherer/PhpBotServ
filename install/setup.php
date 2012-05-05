<?php

$system_root      = $_POST['program_path'];

$server_addr      = $_POST['network_server'];
$server_port      = $_POST['network_port'];
$server_nick      = $_POST['network_nick'];
$server_pass      = $_POST['network_pass'];
$server_real      = $_POST['network_real'];
$server_email     = $_POST['network_email'];
$server_ident     = $_POST['network_ident'];
$server_oper      = $_POST['network_oper'];


$myql_server      = $_POST['mysql_server'];
$myql_user        = $_POST['mysql_user'];
$myql_pass        = $_POST['mysql_password'];
$myql_db          = $_POST['mysql_database'];

$fp = fopen($system_root . "/config.ini", w);

$ini = "

;PHP-BostServ Configuration File
;Compatible with UnrealIRCd

[system]
;This section contains settings related to the system the bot will run on
;system_root:   STRING
;              This is the path to the root directory where the bot will be
;              stored in the file system

system_root = \"{$system_root}\"

[network]
;This section contains network related settings
;
;server_addr:   STRING
;             either an FDQN or IP address that points to the server
;             where the IRCd is running
;server_port:   INT
;             describes what port the IRCd is listening on
;server_nick:   STRING
;             the nickname the bot should connect to the server as
;             the bot will attempt to identify with server_nick
;server_pass:   STRING
;             the NickServ password this bot should use to connect to the server
;server_email:  STRING
;             the email address the bot should use to register its nick
;server_real:   STRING
;             the bot's real name
;server_ident:   STRING
;             the bot's identity
;server_oper:    STRING
;             the Oper name the bot will try to /OPER with

server_addr = \"{$server_addr}\"
server_port = {$server_port}
server_nick = \"{$server_nick}\"
server_pass = \"{$server_pass}\"
server_real = \"{$server_real}\"
server_email = \"{$server_email}\"
server_ident = \"{$server_ident}\"
server_oper = \"{$server_oper}\"

[mysql]
;contains MySQL related settings
;
;mysql_server:  STRING
;             by default 'localhost'
;             either a FDQN string or IP
;mysql_user:    STRING
;             username with access to MySQL server
;mysql_pass:    STRING
;             password to authenticate mysql_user to MySQL
;mysql_db:      STRING
;             the database the program should try to access with username 
;             mysql_user authenticating with mysql_pass

mysql_server = \"{$mysql_server}\"
mysql_user = \"{$mysql_user}\"
mysql_pass = \"{$msql_pass}\"
mysql_db = \"{$mysql_db}\"

";

fwrite ($fp, $ini);

?>
