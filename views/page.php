<?php defined("CATALOG") or die("Access denied");?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=strip_tags($breadcrumbs)?></title>
	<link rel="stylesheet" href="<?=PATH?>views/css/style.css">
	<link type="image/x-icon" href="/views/img/favicon.ico" rel="shortcut icon">
</head>
<body>
	<div class="wrapper">
		<div class="sidebar">
			<?php include "sidebar.php";?>
		</div>
		<div class="content">
		<?php include 'menu.php'; ?>	
		<p><?=$breadcrumbs;?></p>
			<br>
			<hr>
               <div class="page_content">
				   <?=$page['text']?>
			   </div>
		</div>
	</div>
	<script src="<?=PATH?>views/js/jquery-1.9.0.min.js"></script>
	<script src="<?=PATH?>views/js/jquery.accordion.js"></script>
	<script src="<?=PATH?>views/js/jquery.cookie.js"></script>
	<script>
		$(document).ready(function(){
			$(".category").dcAccordion();
		});
	</script>
</body>
</html>