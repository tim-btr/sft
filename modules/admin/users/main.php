<?php
if(isset($_POST['user-search'])) {
	$res = q("
		SELECT * FROM `users` 
		WHERE `login` LIKE '%".escStr($_POST['user-search'])."%'
	");
} else {
	$res = q("
		SELECT * FROM `users`
		ORDER BY `id` ASC
	");
}

if(isset($_SESSION['notice'])){
	$notice = $_SESSION['notice'];
	unset($_SESSION['notice']);
}
