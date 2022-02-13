<?php 
include 'main_controller.php';
include "models/{$view}_model.php";
include "views/{$view}.php";

// ID дочерних категорий

$ids = cats_id($categories, $id);
$ids = !$ids ? $id : rtrim($ids, ",");


/*=========Пагинация==========*/

if (isset($_COOKIE['per_page']) && (int)$_COOKIE['per_page']){
	$perpage = (int)$_COOKIE['per_page'];
}else{
	$perpage = PERPAGE;
}

// общее кол-во товаров
$count_goods = count_goods($ids);

// необходимое кол-во страниц
$count_pages = ceil($count_goods / $perpage);
// минимум 1 страница
if( !$count_pages ) $count_pages = 1;

// получение текущей страницы
if( isset($_GET['page']) ){
	$page = (int)$_GET['page'];
	if( $page < 1 ) $page = 1;
}else{
	$page = 1;
}

// если запрошенная страница больше максимума
if( $page > $count_pages ) $page = $count_pages;

// начальная позиция для запроса
$start_pos = ($page - 1) * $perpage;

$pagination = pagination($page, $count_pages);

/*=========Пагинация==========*/


/**
* Кол-во товаров
**/
function count_goods($ids){
	global $connection;
	if( !$ids ){
		$query = "SELECT COUNT(*) FROM products";
	}else{
		$query = "SELECT COUNT(*) FROM products WHERE parent IN($ids)";
	}
	$res = mysqli_query($connection, $query);
	$count_goods = mysqli_fetch_row($res);
	return $count_goods[0];
}

$products = get_products($ids, $start_pos, $perpage);