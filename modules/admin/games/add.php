<?php 
//выбираем все платформы для вывода
$res = q("
	SELECT * FROM `platform` ORDER BY `id`
");

//выборка параметров данного товара
if(isset($_POST['name'], $_POST['about'], $_FILES) ) {
	$error = array(); 

	if(!isset($_POST['platf'])) {
		$error['platf'] = 'Заполните категории';
	}
		
	if(empty($_POST['name'])) {
		$error['name'] = 'Заполните название';
	}

	if(empty($_POST['about'])) {
		$error['about'] = 'Заполните описание';
	}

	if(empty($_FILES['file']['name'])) {
		$error['file'] = 'Нужно добавить изображение';
	}

	//----------------------------------------------
	//работа с классом по ресайзу
	//----------------------------------------------
	$resObj = new Resize;  
	$resObj->img_path  = '/img/games/100_100/';

	$resObj->uploadNResize($_FILES['file']['name'], $_FILES['file']['tmp_name'], $_FILES['file']['error'], $_FILES['file']['size']);

	$link = $resObj->imgResize($resObj->name, $resObj->extent, $resObj->width, $resObj->height, 100, 100);

	$resObj->img_path  = '/img/games/300_300/';

	$link2 = $resObj->imgResize($resObj->name, $resObj->extent, $resObj->width, $resObj->height, 300, 300);

	@unlink('.'.$resObj->name);


	if(isset($resizeObj->error) && $resizeObj->error != '') {
		$error['file'] = $resizeObj->error;
	}


	//----------------------------------------------
	//заносим данные в БД
	//----------------------------------------------
	if(count($error) == 0) {
		//заносим игру 
		q("
			INSERT INTO `games` SET
			`name`  = '".escStr($_POST['name'])."',
			`about` = '".escStr($_POST['about'])."',
			`link`  = '".escStr($link)."' 
		");
		
		//заносим платформы
		$last_id = DbConnect::_()->insert_id;
		$sql = "INSERT INTO `games2platform` (`games_id`,`platf_id`) VALUES ";
		$values = array();

		foreach($_POST['platf'] as $k=>$v) {
			$values[] = "(".$last_id.",".$v.")";
		}
			
		$sql .= implode(',' , $values);
		q($sql);

		$_SESSION['notice'] = 'Данные были успешно добавлены';
		header('Location: /admin/games/main'); exit;
	}
}