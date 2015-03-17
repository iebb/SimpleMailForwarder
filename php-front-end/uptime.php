<?php
function sec2human($time) {
  $seconds = $time%60;
	$mins = floor($time/60)%60;
	$hours = floor($time/60/60)%24;
	$days = floor($time/60/60/24);
	return $days > 0 ? $days . ' day'.($days > 1 ? 's' : '') : $hours.':'.$mins.':'.$seconds;
}
function cv($num){
	$u=array("","k","M","G","T");
	$x=0;
	while($num>=1024){
		$num/=1024.0;
		$x++;
	}
	return number_format($num,2).$u[$x];
}
$array = array();
$fh = fopen('/proc/uptime', 'r');
$uptime = fgets($fh);
fclose($fh);
$uptime = explode('.', $uptime, 2);
$array['uptime'] = sec2human($uptime[0]);


$fh = fopen('/proc/meminfo', 'r');
  $mem = 0;
  while ($line = fgets($fh)) {
    $pieces = array();
    if (preg_match('/^MemTotal:\s+(\d+)\skB$/', $line, $pieces)) {
      $memtotal = $pieces[1];
    }
    if (preg_match('/^MemFree:\s+(\d+)\skB$/', $line, $pieces)) {
      $memfree = $pieces[1];
    }
    if (preg_match('/^Cached:\s+(\d+)\skB$/', $line, $pieces)) {
      $memcache = $pieces[1];
      break;
    }
  }
fclose($fh);

$memmath = $memcache + $memfree;
$memmath2 = 100-($memmath / $memtotal * 100);
$memory = number_format($memmath2,2);

if ($memory >= 75) { $memlevel = "danger"; }
elseif ($memory <= 50) { $memlevel = "success"; }
else { $memlevel = "warning"; }

$array['memory'] = '<div class="progress progress-striped active">
<div class="bar bar-'.$memlevel.'" style="width: '.$memory.'%;"><span>'.cv(($memtotal-$memmath)*1024).'/'. cv($memtotal*1024).'</span></div>
</div>';

$hddtotal = disk_total_space("/");
$hddfree = disk_free_space("/");
$hddmath = (100 - $hddfree / $hddtotal * 100);
$hdd = number_format($hddmath,2);

if ($hdd >= 75) { $hddlevel = "danger"; }
elseif ($hdd <= 50) { $hddlevel = "success"; }
else { $hddlevel = "warning"; }


$array['hdd'] = '<div class="progress progress-striped active">
<div class="bar bar-'.$hddlevel.'" style="width: '.$hdd.'%;"><span>'.cv(disk_total_space("/")-disk_free_space("/")).'/'. cv(disk_total_space("/")).'</span></div>
</div>';

$loadmath = sys_getloadavg();
$load = number_format($loadmath[0],2);

$array['load'] =  $load;


$array['online'] = '<div class="progress">
<div class="bar bar-success" style="width: 100%;"><small>Up</small></div>
</div>';

echo json_encode($array);
