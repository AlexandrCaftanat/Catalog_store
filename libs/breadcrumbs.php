<?php 
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

