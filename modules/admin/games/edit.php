<?php 
//выбираем категории
$res = q("
	SELECT * FROM `platform` ORDER BY `id`
");

//выборка параметров данного товара
if(isset($_GET['key2']) && $_GET['key2'] == 'edit') {
	$query = q("
		SELECT * FROM `games`
		WHERE `id` = '".(int)$_GET['key3']."'
		LIMIT 1
	");
	
	if(!$query->num_rows) {
		$_SESSION['notice'] = 'Данной записи не существует';
		header('Location: /admin/games/main');
		exit();
	}
	
	$row = $query->fetch_assoc();


	//выборка платформ для вставки в поля редактирования
	$query2 = q("
		SELECT `platf_id` FROM `games2platform`
		WHERE `games_id` = ".(int)$_GET['key3']
	);

	$ids = array();

	while($str = $query2->fetch_assoc()) {
		$ids[] = $str['platf_id'];
	}

	$query2->close();
}


if(isset($_POST['name'], $_POST['about'], $_FILES)) {

	$error = array();

	if(!isset($_POST['platf'])) {
		$error['platf'] = 'Заполните категории';
	}

	if(empty($_POST['name'])) {
		$error['name'] = 'Нет названия';
	}

	if(empty($_POST['about'])) {
		$error['about'] = 'Нет описания';
	}

	if(empty($_FILES['file']['name'])) {
		$error['file'] = 'Не заполнено поле изображения';
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
	//заносим все в БД
	//----------------------------------------------
	if(!count($error)) {
		q("
			UPDATE `games` SET 
			`name`     = '".escStr($_POST['name'])."',
			`about`    = '".escStr($_POST['about'])."',
			`link`     = '".escStr($link)."'
			WHERE `id` = ".(int)$_GET['key3']
		); 

		q("
			DELETE FROM `games2platform`
			WHERE `games_id` = ".(int)$_GET['key3']
		);
		
		//заносим платформы
		$sql = "INSERT INTO `games2platform` (`games_id`,`platf_id`) VALUES ";
		$values = array();

		foreach($_POST['platf'] as $k=>$v) {
			$values[] = "(".(int)$_GET['key3'].",".$v.")";
		}
			
		$sql .= implode(',' , $values);
		q($sql);

		$_SESSION['notice'] = 'Запись была успешно изменена';
		header('Location: /admin/games/main'); exit();
	}

}