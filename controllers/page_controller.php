<?php

defined("CATALOG") or die("Access denied");

include "main_controller.php";
include "models/{$view}_model.php";

//Получение контента страницы
$page = get_one_page($page_alias);

if (!$page) {
    include 'views/404.php';
	exit;
}

//Новые хлебные крошки
$breadcrumbs = "<a href='". PATH ."'>Главная/ {$page['title']}</a>";
//print_arr($page);

// Подключение вида
include "views/{$view}.php";

