<?php 
//достаем категории
$categories = array();

$res = q("
	SELECT `category` FROM `category`
");

while($row = $res->fetch_assoc()) {
	$categories[] = $row['category'];
}

$res->close();

//проверки данных полей
if(isset($_POST['category'], $_POST['name'], $_POST['model'], $_POST['cost'], $_POST['article'], $_POST['about'], $_FILES )) {
	$error = array();
	if(empty($_POST['category'])) {
		$error['category'] = 'Категория товара не выбрана';
	}
	
	if(empty($_POST['name'])) {
		$error['name'] = 'Нет названия товара';
	}
	
	if(empty($_POST['cost'])) {
		$error['cost'] = 'Нет цены товара';
	}
	
	if(empty($_POST['article'])) {
		$error['article'] = 'Нет кода/артикула товара';
	}
	
	if(empty($_POST['about'])) {
		$error['about'] = 'Нет описания товара';
	}
	
	if(empty($_FILES['file']['name'])) {
		$error['file'] = 'Не заполнено поле изображения';
	}

	//----------------------------------------------
	//работа с классом по ресайзу
	//----------------------------------------------

	$resObj = new Resize;  
	$resObj->img_path  = '/img/goods/80_80/';


	$resObj->uploadNResize($_FILES['file']['name'], $_FILES['file']['tmp_name'], $_FILES['file']['error'], $_FILES['file']['size']);

	$link = $resObj->imgResize($resObj->name, $resObj->extent, $resObj->width, $resObj->height, 80, 80);

	$resObj->img_path  = '/img/goods/300_300/';

	$link2 = $resObj->imgResize($resObj->name, $resObj->extent, $resObj->width, $resObj->height, 300, 300);

	unlink('.'.$resObj->name);


	if(isset($resizeObj->error) && $resizeObj->error != '') {
		$error['file'] = $resizeObj->error;
	}	

	//----------------------------------------------
	//заносим все в БД
	//----------------------------------------------
	if(!count($error)) {
		q("
			INSERT INTO `goods` SET 
			`category` = '".escStr($_POST['category'])."',
			`name`     = '".escStr($_POST['name'])."',
			`model`    = '".escStr($_POST['model'])."',
			`cost`     = ".(int)$_POST['cost'].",
			`about`    = '".escStr($_POST['about'])."',
			`article`  =  '".escStr($_POST['article'])."',
			`link`     = '".escStr($link)."'
		"); 
		
		$_SESSION['notice'] = 'Товар был успешно добавлен';
		header('Location: /admin/products/main');
		exit();
		
	}	
}