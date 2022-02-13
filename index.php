<?php
	
	error_reporting(E_ALL);

	define("CATALOG", true);


include 'config.php';
include 'functions.php';

/* Router маршрутизация*/

// Массив паттернов для роутинга
$routes = [
	['url' => '#^$|^\?#', 'view' => 'category'],
	['url'=> '#^product/(?P<product_alias>[a-z0-9-]+)#i', 'view' => 'product'],
	['url' => '#^category/(?P<id>\d+)#i', 'view' => 'category'],
];

//Обработка url для функции роутинга

$url = $_SERVER['REQUEST_URI'];
$url = ltrim($url, '/');

// Функция роутинга

foreach ($routes as $route) {
	if (preg_match($route['url'], $url, $match)) {
		$view = $route['view'];
		break;
	}
}
//print_arr($match);
// Проверка на не валидный url

if (empty($match)){ include 'views/404.php';
	exit;
}

extract($match);



// $id = ID категории
// $product_alias = alias продукта
// $view = Вид для подключения

/* Router Функции маршрутизации*/



$categories = get_cat();
$categories_tree = map_tree($categories);
$categories_menu = categories_to_string($categories_tree);

/**
* может быть либо ID продукта, либо ID категории... если есть ID продукта, тогда ID категории возьмем из поля parent, иначе - возьмем сразу из параметра
**/
if( isset($product_alias) ){
	// массив данных продукта
	
	$get_one_product = get_one_product($product_alias);
	
	// получаем ID категории
	$id = $get_one_product['parent'];
}

// хлебные крошки
// return true (array not empty) || return false
$breadcrumbs_array = breadcrumbs($categories, $id);

if($breadcrumbs_array){
	$breadcrumbs = "<a href='" .PATH. "'>Главная</a> / ";
	foreach($breadcrumbs_array as $id => $title){
		$breadcrumbs .= "<a href='" .PATH. "category/{$id}'>{$title}</a> / ";
	}
	if( !isset($get_one_product) ){
		$breadcrumbs = rtrim($breadcrumbs, " / ");
		$breadcrumbs = preg_replace("#(.+)?<a.+>(.+)</a>$#", "$1$2", $breadcrumbs);
	}else{
		$breadcrumbs .= $get_one_product['title'];
	}
}else{
	$breadcrumbs = "<a href='" .PATH. "'>Главная</a> / Каталог";
}

// ID дочерних категорий
$ids = cats_id($categories, $id);
$ids = !$ids ? $id : rtrim($ids, ",");

/*=========Пагинация==========*/

// кол-во товаров на страницу

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

$products = get_products($ids, $start_pos, $perpage);

include "views/{$view}.php";