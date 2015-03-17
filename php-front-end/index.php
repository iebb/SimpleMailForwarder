<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='//fonts.lug.ustc.edu.cn/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/bs.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/ieb.css"> <!-- CSS reset -->
  	
	<title>Make Mail Easy</title>
</head>
<body>
	<header>
		<h1 style="font-size:45px;">Create Your Forwarder</h1>
	</header>
	
	<?php include 'db.php';?>
	<div class="cd-form-wrapper cd-container" style="width:500px">
		<div class="form-group">
				<div class="input-group">
				  <input class="form-control input-lg inputbox" type="text" value="" placeholder="yourname" name="prefix" id="prefix">
			   <div class="input-group-btn">
				<button type="button" class="btn btn-default dropdown-toggle btn-lg btnbox" data-toggle="dropdown" id="btn">@<span id="ext">???</span> <span class="caret"></span></button>
				<ul class="dropdown-menu">
				<?php 
				$sql= "SELECT domain FROM domains WHERE open=1 ORDER by domain ASC";
				$r=mysql_query($sql);
				while($w=mysql_fetch_object($r)){
					?>
				    <li><a href="#"><?=$w->domain?></a></li>
					<?php
				}?>
				</ul>
				 <input type="hidden" name="category" class="category">
			  </div><!-- /btn-group -->
				</div>
				
				<div class="input-group">
				  <input class="form-control input-lg inputbox" type="text" value="" placeholder="your existing mail" name="dest" id="dest">
			   <div class="input-group-btn">
				<button type="button" class="btn btn-lg btnbox" id="check" onclick="$('#msg').load('./check_availability.php?prefix='+$('#prefix').val()+'&domain='+$('#ext').text())">Check</button>
				</div>
			  </div>
				<div class="input-group">
				  <input class="form-control input-lg inputbox" type="password" value="" placeholder="management password" name="pass" id="pass">
			   <div class="input-group-btn">
				<button type="button" class="btn btn-lg btnbox" id="submit" onclick="$('#msg').load('./create.php?prefix='+$('#prefix').val()+'&email='+$('#dest').val()+'&password='+$('#pass').val()+'&domain='+$('#ext').text())">Get it!</button>
			  </div>
			  </div>
        </div>
	</div>
		<div style="position: relative;height: 120px;line-height: 150px;text-align: center;">
			<h1 id="msg">Such easy, many wow</h1>
		</div>
	<div style="position: relative;height: 120px;line-height: 150px;text-align: center;">
		<h1>Use your own domain?</h1>
	</div>
	<div style="text-align:center">
	<p>
	Add a TXT record to the root of your domain like this:<br/>
	<code>rainmail_public=0;rainmail_hash=c2db07b76c59ec912e07006e6d2d780d;rainmail_share_hash=e165421110ba03099a1c0393373c5b43;</code><br/>
	<code>rainmail_hash</code> is the MD5 Hash of your management password; <code>rainmail_public</code> 0 for private and 1 for public<br/>
	<code>rainmail_share_hash</code> (only when rainmail_public=0) is the MD5 Hash of your sharing key (only person has this key is allowed to register under the domain)<br/>
	Add MX records to the root of your domain: <code><?=$mx1?> (priority 10)</code> <code><?=$mx2?> (priority 20)</code>
	</p>
	
	<div class="cd-form-wrapper cd-container" style="width:500px">
		<div class="input-group">
		  <input class="form-control input-lg inputbox" type="text" value="" placeholder="your domain" id="domain">
	   <div class="input-group-btn">
		<button type="button" class="btn btn-lg btnbox" id="submit" onclick="$('#msg').load('./verify_domain.php?domain='+$('#domain').val())">Verify!</button>
	  </div>
	  </div>
	</div>
	</div>
	<br/>
	<br/>
	<br/>
<script src="js/jquery-2.1.1.js"></script>
<script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
</body>
<script>
$('.dropdown-menu li').click(function(e){
  e.preventDefault();
  var selected = $(this).text();
  $('.final').val(selected);  
  $('#ext').html(selected);  
});
</script>
</html>