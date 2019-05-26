<?php
Core::$CSS[] = '<link rel="stylesheet" href="/css/comments.css">';
Core::$CSS[] = '<link rel="stylesheet" href="/css/game.css">';
Core::$JS[]  = '<script src="/js/news.js"></script>';

if(isset($_SESSION['user']) && ($_SESSION['user']['access'] >= 1 &&
$_SESSION['user']['access'] < 5)) {

	if(isset($_POST['title'], $_POST['textarea'])) {
		$errors = array();
		$datas  = array();
		
		if(empty($_POST['title'])) {
			$errors['title'] = 'Вы не заполнили логин';
		}
		
		if(empty($_POST['textarea'])) {
			$errors['text'] = 'Вы не заполнили текст сообщения';
		}
		
		if(count($errors) == 0) {
			
			$query = "INSERT INTO `news` SET 
				`title` = '".escStr($_POST['title'])."',
				`date` = NOW(),
			    `text` = '".escStr($_POST['textarea'])."'";
			q($query);
			

			$datas['title'] = $_POST['title'];
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

if(isset($_POST['interval']) && true == $_POST['interval']) {
	$res = q("SELECT * FROM `news` ORDER BY `id` ASC");
	$news = array();

	while($row = $res->fetch_assoc()) {
		$news[] = $row;
	}

	echo json_encode($news);
	exit;
}




