<?php
	$domain=preg_replace('[^0-9A-Za-z\-.]','',$_GET['domain']);
	$prefix=preg_replace('[^0-9A-Za-z\-.]','',$_GET['prefix']);
	$email=preg_replace('[^0-9A-Za-z\-.@]','',$_GET['email']);
	$password=$_GET['password'];
	include 'db.php';
	$sql = "SELECT * FROM   `forwarding`  WHERE  `prefix`='".mysql_escape_string($prefix)."' AND  `domain`='".mysql_escape_string($domain)."'";
	$r=mysql_query($sql);
	$avail=(mysql_num_rows($r)==0);
	if (!$avail) {
		$row=mysql_fetch_object($r);
		if ($row->password === md5($password)){
			$sql = "REPLACE INTO `forwarding` VALUES('".mysql_escape_string($prefix)."','".mysql_escape_string($domain)."','".mysql_escape_string($email)."','".md5($password)."');";
			$r=mysql_query($sql);
			die("Updated $prefix@$domain = $email :)");  
		}
		die("It's Taken :( ");  
	}
	
	$sql = "REPLACE INTO `forwarding` VALUES('".mysql_escape_string($prefix)."','".mysql_escape_string($domain)."','".mysql_escape_string($email)."','".md5($password)."');";
	$r=mysql_query($sql);
	die("Created $prefix@$domain = $email :)");  
?>