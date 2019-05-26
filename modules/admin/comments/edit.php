<?php 
if(isset($_GET['key2']) && $_GET['key2'] == 'edit') {
	$query = q("
		SELECT * FROM `comments`
		WHERE `id` = '".$_GET['key3']."'
		LIMIT 1
	");
	
	if(!$query->num_rows) {
		$_SESSION['notice'] = 'Данной записи не существует';
		header('Location: /admin/comments/main');
		exit();
	}
	
	$row = $query->fetch_assoc();

	$query->close();
}

if(isset($_POST['name'], $_POST['text'], $_POST['date']) ) {
	$error = array();
	
	if(empty($_POST['name'])) {
		$error['name'] = 'Не заполнено поле имя';
	}
	
	if(empty($_POST['text'])) {
		$error['text'] = 'Не заполнено поле имя';
	}
	
	if(count($error) == 0) {
		q("
			UPDATE `comments` SET 
			`name` = '".escStr($_POST['name'])."',
			`text` = '".escStr($_POST['text'])."'
			WHERE `id` = ".(int)$_GET['key3']
		);
		
		$_SESSION['notice'] = 'Запись отредактирована.';
		header('Location: /admin/comments/main');
		exit();
	}
}


if(isset($_SESSION['notice'])) {
	$notice = $_SESSION['notice'];
	unset($_SESSION['notice']);
}
