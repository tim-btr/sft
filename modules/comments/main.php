<?php
Core::$CSS[] = '<link rel="stylesheet" href="/css/comments.css">';
Core::$CSS[] = '<link rel="stylesheet" href="/css/game.css">';
Core::$JS[]  = '<script src="/js/comments.js"></script>';

if(isset($_SESSION['user']) && ($_SESSION['user']['access'] >= 1 &&
$_SESSION['user']['access'] < 5)) {
	sleep(1);
	if(isset($_POST['nick_name'], $_POST['textarea'])) {
		$errors = array();
		$datas  = array();
		
		if(empty($_POST['nick_name'])) {
			$errors['name'] = 'Вы не заполнили логин';
		}
		
		if(empty($_POST['textarea'])) {
			$errors['text'] = 'Вы не заполнили текст сообщения';
		}
		
		if(count($errors) == 0) {
			
			$query = "INSERT INTO `comments` SET 
				`name` = '".escStr($_POST['nick_name'])."',
				`date` = NOW(),
			    `text` = '".escStr($_POST['textarea'])."'";
			q($query);
			
			$datas['name'] = $_POST['nick_name'];
			$datas['text'] = $_POST['textarea'];
			$datas['date'] = date('Y-m-d H:i:s');
			$datas['id']   = DbConnect::_()->insert_id;

			echo json_encode($datas);
			exit;
		} else {
			$datas['error'] = 'Все поля должны быть заполнены';
			echo json_encode($datas);
			exit;
		}
	} 
}

$result = q("SELECT * FROM `comments` ORDER BY `id` ASC");

