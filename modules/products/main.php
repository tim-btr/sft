<?php 
Core::$CSS[] = '<link rel="stylesheet" href="/css/products.css">';

$categories = array(
	'Антивирусы',
	'Офисные программы',
	'Операционные системы',
	'Интернет',
	'Мультимедиа',
	'Иное ПО'
);

$cat_for_sql = array(
	'antivirus',
	'office',
	'os',
	'internet',
	'multimedia',
	'another'
);

if (isset($_POST['category'])) {
	$query = q("
		SELECT * FROM `goods` 
		WHERE `category` = '".escStr($_POST['category'])."'
		ORDER BY `id` DESC
		");
} else {
	$query = q("SELECT * FROM `goods` ORDER BY `id` DESC");
}

if(isset($_SESSION['notice']) ) {
	$notice = $_SESSION['notice'];
	unset($_SESSION['notice']);
}

