<?php

define("CATALOG", true);
error_reporting(E_ALL);

/* Router маршрутизация*/

// Массив паттернов для роутинга
$routes = [
	['url' => '#^$|^\?#', 'view' => 'category'],
	['url'=> '#^product/(?P<product_alias>[a-z0-9-]+)#i', 'view' => 'product'],
	['url' => '#^category/(?P<id>\d+)#i', 'view' => 'category'],
	['url' => '#^page/(?P<page_alias>[a-z0-9-]+)#i', 'view' => 'page'],
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

// Проверка на не валидный url

if (empty($match)){
	include 'views/404.php';
	exit;
}

extract($match);

// $id = ID категории
// $product_alias = alias продукта
// $view = Вид для подключения

// Подключения контроллера
include "controllers/{$view}_controller.php";





