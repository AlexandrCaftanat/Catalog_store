<?php defined("CATALOG") or die("Access denied");?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Каталог</title>
	<link rel="stylesheet" href="<?=PATH?>views/css/style.css">
	<link type="image/x-icon" href="/views/img/favicon.ico" rel="shortcut icon">
</head>
<body>
	<a href="/">Главная</a>
	<div class="wrapper">
		<div class="sidebar">
			<?php include "sidebar.php";?>
		</div>
		<div class="content">
			<p><?=$breadcrumbs;?></p>
			<br>
			<hr>
<?php if($get_one_product): ?>
	<?php print_arr($get_one_product); ?>
<?php else: ?>
	Такого товара нет
<?php endif; ?>
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