<?php
//context.php
$db_server = '127.0.0.1';
$db_user = 'root';
$db_pw = 'root';
$db_name = 'fian211';

$mysqli = new mysqli($db_server, $db_user, $db_pw, $db_name);

if($mysqli -> connect_error)
{
	echo('Fehler 01734');
	die;
}

if(!$mysqli -> set_charset("utf8")){

	exit("could not change charset");
}
?>