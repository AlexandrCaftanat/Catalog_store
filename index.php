<?php
	

	define("CATALOG", true);
error_reporting(E_ALL);

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

include "controllers/{$view}_controller.php";
exit;

/* Router Функции маршрутизации*/


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



/*=========Пагинация==========*/




