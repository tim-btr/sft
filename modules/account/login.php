<?php 
Core::$CSS[] = '<link rel="stylesheet" href="/css/game.css">';


if(isset($_POST['login'], $_POST['pass'])) { 
	$res = q("
		SELECT * FROM `users` WHERE
		`login`    = '".escStr($_POST['login'])."' AND 
		`password` = '".escStr(myHash($_POST['pass']))."' AND 
		`active`   = 1
		LIMIT 1
	");
	if($res->num_rows) {
		$_SESSION['user'] = $res->fetch_array();
		$login = 'ok';
		
		if(isset($_POST['rememberme'])) {
			setcookie('auth_id',(int)$_SESSION['user']['id'],time()+1500,'/');
			$_COOKIE['auth_id'] = (int)$_SESSION['user']['id'];
			
			setcookie('auth_hash',escStr(myHash($_SESSION['user']['id'].$_SESSION['user']['login'].$_SESSION['user']['email']),time()+1500,'/'));
			$_COOKIE['auth_hash'] = escStr(myHash($_SESSION['user']['id'].$_SESSION['user']['login'].$_SESSION['user']['email']));
			
			q("
				UPDATE `users` SET 
				`hash`     = '".escStr(myHash($_SESSION['user']['id'].$_SESSION['user']['login'].$_SESSION['user']['email']))."',
				`addition` = '".escStr(myHash($_SERVER['HTTP_USER_AGENT']))."'
				WHERE
				`id`    = ".(int)$_SESSION['user']['id']." AND 
			    `login` = '".escStr($_SESSION['user']['login'])."'
			");
		}
		header('Location: /'); exit;
	} else {
		$status = '<p><b>Неправильные данные</b></p>';
	}
}

if(isset($_GET['exit']) && 1 == $_GET['exit']) {
	include './modules/account/exit.php';
}
