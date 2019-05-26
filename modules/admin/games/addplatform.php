<?php 
$res = q("SELECT * FROM `platform`");

if(isset($_POST['platf'])) {
	if(empty($_POST['platf'])) {
		$error = 'Необходимо заполнить значение';
	}

	if(!isset($error)) {
		q("
			INSERT INTO `platform` 
			SET `platform` = '".escStr($_POST['platf'])."'
		");

		$_SESSION['notice'] = 'Данные были успешно добавлены';
		header("Location: /admin/games/add"); exit;
	}
}

if(isset($_SESSION['notice']) ) {
	$notice = $_SESSION['notice'];
	unset($_SESSION['notice']);
}