<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link type="text/css" rel="stylesheet" href="/assets/css/bootstrap.css" />
	<link type="text/css" rel="stylesheet" href="/assets/css/admin.css" />
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<script type="text/javascript">
/*
$(document).ready(function() {
	
	$('some input').click(function ()
	{
		// Some stuff
	});
	
});
*/
</script>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
    padding: 0;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
h1 {
	text-align: center;
}
</style>
</head>
<body>
<?php echo $menu; ?>
    <div id="content">
	<h1>Centro Bless</h1>
	<center><img src="/assets/img/2015LOGOBLESSnuevochico.png" /></center>
    </div>
</body>
</html>
