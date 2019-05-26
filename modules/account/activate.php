<?php 
if(isset($_GET['hash'])) {
	q("
		UPDATE `users` SET 
		`active` = 1, 
		`access` = 1
		WHERE `hash` = '".escStr($_GET['hash'])."'
		AND   `id`   = ".(int)$_GET['id']
	);  
	
	$notice = 'Ваша учётная запись активирована';
	
	$res = q("
		SELECT * FROM `users` 
		WHERE `hash` = '".escStr($_GET['hash'])."'
		AND   `id`   = ".(int)$_GET['id']."
		LIMIT 1
	");
	if($res->num_rows) {
		$_SESSION['user'] = mysqli_fetch_assoc($res);
	}
} else {
	$notice = 'Вы прошли по неверной ссылке';
}
$res->close;