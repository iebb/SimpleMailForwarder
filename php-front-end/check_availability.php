<?php
	$domain=preg_replace('[^0-9A-Za-z\-.]','',$_GET['domain']);
	$prefix=preg_replace('[^0-9A-Za-z\-.]','',$_GET['prefix']);
	include 'db.php';
	$sql = "SELECT `destination` FROM   `forwarding`  WHERE  `prefix`='".mysql_escape_string($prefix)."' AND  `domain`='".mysql_escape_string($domain)."'";
	$r=mysql_query($sql);
	$avail=(mysql_num_rows($r)==0);
	echo $avail?"That's available :)":"It's Taken :(";  
?>