<?php
if(isset($_GET['module'])) {
	$res = q("
		SELECT * FROM `meta`
		WHERE `module` = '".$_GET['module']."'
		LIMIT 1
	");
	
	$row = $res->fetch_assoc();
	Core::$META['title'] = $row['title'];
}


if(isset($_SESSION['user'])) {
	$res = q("
		SELECT * FROM `users`
		WHERE `id` = ".(int)$_SESSION['user']['id']."
		LIMIT 1
	");
	
	$_SESSION['user'] = $res->fetch_assoc();
	
	if($_SESSION['user']['active'] != 1) {
		include './modules/account/exit.php';
	}
} elseif(isset($_COOKIE['auth_id'], $_COOKIE['auth_hash'])) {
	$res = q("
		SELECT * FROM `users` WHERE
		`id`   = ".(int)$_COOKIE['auth_id']." AND
		`hash` = '".escStr($_COOKIE['auth_hash'])."' AND 
		`addition` = '".escStr(myHash($_SERVER['HTTP_USER_AGENT']))."'
		LIMIT 1
	");
	
	if($res->num_rows) {
		$_SESSION['user'] = $res->fetch_assoc();
	} else {
		include './modules/account/exit.php';
	}
} 
$res->close();