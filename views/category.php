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

			<div>
				<select name="perpage" id="perpage">
					<?php foreach($option_perpage as $option): ?>
						<option <?php if($perpage == $option) echo "selected"; ?> value="<?=$option?>"> <?=$option?> товаров на страницу</option>
					<?php endforeach; ?>
				</select>
			</div>

			<?php if($products): ?>
				
				<?php if( $count_pages > 1 ): ?>
					<div class="pagination"><?=$pagination?></div>
				<?php endif; ?>

				<!-- ссылка на товар -->

				<?php foreach($products as $product): ?>
					<a href="<?=PATH?>product/<?=$product['alias']?>"><?=$product['title']?></a><br>
				<?php endforeach; ?>

				<?php if( $count_pages > 1 ): ?>
					<div class="pagination"><?=$pagination?></div>
				<?php endif; ?>
				
			<?php else: ?>
				<p>Здесь товаров нет!</p>
			<?php endif; ?>
		</div>
	</div>
	<script src="<?=PATH?>views/js/jquery-1.9.0.min.js"></script>
	<script src="<?=PATH?>views/js/jquery.accordion.js"></script>
	<script src="<?=PATH?>views/js/jquery.cookie.js"></script>
	<script>
		$(document).ready(function(){
			$(".category").dcAccordion();
			$("#perpage").change(function(){
				var perPage = this.value; // $(this).val()
				$.cookie('per_page', perPage, {expires:7, path:'/'});
				window.location = location.href;
			});
		});
	</script>
</body>
</html>