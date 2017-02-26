<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link type="text/css" rel="stylesheet" href="/assets/css/bootstrap.css" />
	<link type="text/css" rel="stylesheet" href="/assets/css/admin.css" />
<?php foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
</head>
<body>
<input type="hidden" id="siteurl" value="siteurl" />
<?php echo $menu; ?>
<div id="content">
    <div id="calendario">
    </div>
<div id="ghostbox"></div>
</div>
</body>
</html>
