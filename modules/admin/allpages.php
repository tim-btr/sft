<?php 
include './modules/allpages.php';

if(isset($_SESSION['user'])) {
	$res = q("
		SELECT * FROM `users`
		WHERE `id` = ".(int)$_SESSION['user']['id']."
		LIMIT 1
	");
	
	$_SESSION['user'] = $res->fetch_assoc();
	
	if($_SESSION['user']['access'] != 2) {
		include './modules/account/exit.php';
	}
} else {
	if($_GET['module'] != 'static' || $_GET['page'] != 'main') { 
		header("Location: /admin/static/main");		
		exit();			
	}
}
