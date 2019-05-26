<?php 
Core::$CSS[] = '<link rel="stylesheet" href="/css/game.css">';

if(isset($_POST['login'], $_POST['name'], $_POST['pass'], $_POST['email']) ) {
	$errors = array();
	
	if(empty($_POST['login'])) {
		$errors['login'] = 'Не заполнен логин';
	} elseif(mb_strlen($_POST['login']) < 2) {
		$errors['login'] = 'Логин слишком короткий';
	} elseif(mb_strlen($_POST['login']) > 12) {
		$errors['login'] = 'Логин слишком длинный';
	}

	if(empty($_POST['name'])) {
		$errors['name'] = 'Не заполнено имя';
	}

	if(empty($_POST['pass'])) {
		$errors['pass'] = 'Не заполнен пароль';
	} elseif(mb_strlen($_POST['pass']) > 8) {
		$errors['pass'] = 'Пароль слишком длинный';
	} elseif(mb_strlen($_POST['pass']) < 3) {
		$errors['pass'] = 'Пароль слишком короткий';
	}
	
	if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Не заполнен емейл или он некорректен';
	}
	
	if(count($errors) == 0) {
		$res = q("
			SELECT * FROM `users`
			WHERE `login` = '".escStr($_POST['login'])."'
			LIMIT 1
		");
		if($res->num_rows) {
			$errors['login'] = 'Пользователь с таким логином уже существует';
		}
		
		$res = q("
			SELECT * FROM `users`
			WHERE `email` = '".escStr($_POST['email'])."'
			LIMIT 1
		");
		if($res->num_rows) {
			$errors['email'] = 'Пользователь с такой эл. почтой уже существует';
		}
		
	}
	
	if(count($errors) == 0) {
		q("
			INSERT INTO `users` SET
			`login`    = '".escStr($_POST['login'])."',
			`password` = '".escStr(myHash($_POST['pass']))."',
			`name`     = '".escStr($_POST['name'])."',
			`email`    = '".escStr($_POST['email'])."',
			`age`      = ".(int)$_POST['age'].",
			`sex`      = '".escStr($_POST['sex'])."',
			`hash`     = '".escStr(myHash($_POST['login'].$_POST['email']))."'
		");

		//$id = mysqli_insert_id($con);
		//$id = DbConnect::_()->insert_id();

		$_SESSION['register'] = 'ok';
		
		Mail::$to = escStr($_POST['email']);
		Mail::$subject = 'Подтверждение регистрации';
		Mail::$text = '
			Чтобы активировать Вашу учётную запись, пройдите по <a href="'.Core::$domain.'/index.php?module=account&page=activate&id='.$id.'&hash='.escStr(myHash($_POST['login'].$_POST['email'])).'">данной ссылке</a> ';
		Mail::send();
		
		header('Location: /account/register');
		exit;
	}
}