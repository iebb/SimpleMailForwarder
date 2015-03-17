<?php
	define('MYSQL_SERVER', 'localhost');
	define('MYSQL_USER', 'YOUR SQL USER');
	define('MYSQL_PASSWORD', 'YOUR SQL PASSWORD');
	define('MYSQL_DATABASE', 'mymail');
	mysql_pconnect(MYSQL_SERVER,MYSQL_USER,MYSQL_PASSWORD);
	mysql_select_db(MYSQL_DATABASE);
	
	/* Your MX servers */
	$mx1='mx1.og.gs';
	$mx2='mx2.og.gs';
?>