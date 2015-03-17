<?php
	include 'db.php';
	$domain=preg_replace('[^0-9A-Za-z\-]','',$_GET['domain']);
	$domain=strtolower($domain);
	$mx = dns_get_record($domain,DNS_MX);
	$mxs=0;
	$tl='';
	foreach($mx as $record){
		$tl.=$record['target'].';';
		if ($record['target']==$mx1) $mxs=1;
		if ($record['target']==$mx2) $mxs=1;
	}
	if (!$mxs) die('MX not set: MXs are ['.$tl.']');
	$txt = dns_get_record($domain,DNS_TXT);
	foreach($txt as $record){
		$T=$record['txt'];
		$s=explode(';',$T);
		foreach($s as $k){
			$v=explode('=',$k);
			$data[$v[0]]=$v[1];
		}
	}
	if (!isset($data['rainmail_hash'])) die('rainmail_hash not set');
	if (!isset($data['rainmail_public'])) die('rainmail_public not set');
	$rh=mysql_escape_string($data['rainmail_hash']);
	$rp=(int)($data['rainmail_public']);
	$rs='';
	if ($rp==0){
		if (!isset($data['rainmail_share_hash'])) die('rainmail_share_hash not set');
		$rs=mysql_escape_string($data['rainmail_share_hash']);
	}
	
	$sql = "REPLACE INTO `domains` VALUES('".mysql_escape_string($domain)."','".mysql_escape_string($rs)."','".mysql_escape_string($rh)."','".$rp."');";
	$r=mysql_query($sql);
	$sql= "SELECT domain FROM domains";
	$r=mysql_query($sql);
	$exim='/etc/exim4/virtual_domains';
	$ct="";
	while($w=mysql_fetch_object($r)){
		$ct.=$w->domain."\n";
	}
	file_put_contents($exim,$ct);
	die("Updated $domain :)");  
?>