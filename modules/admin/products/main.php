<?php
if(isset($_GET['key2']) && $_GET['key2'] == 'del') {
	q("
		DELETE FROM `goods`
		WHERE `id` = '".(int)$_GET['key3']."'
	");
	
	$_SESSION['notice'] = 'Запись была успешно удалена';
	header('Location:/admin/products/main');
	exit();
}

if(isset($_POST['delall']) ) {

	if(isset($_POST['ids']) ) { 
		foreach($_POST['ids'] as $k=>$v) {
			$_POST['ids'][$k] = (int)$v;
		}
	
		$ids = implode(',', $_POST['ids']);
		q("
			DELETE FROM `goods`
			WHERE `id` IN (".$ids.")
		");
	
		$_SESSION['notice'] = 'Записи были успешно удалены';
		header('Location:/admin/products/main');
		exit(); 
	} else {
		$_SESSION['notice'] = 'Вы должны выделить те записи, которые хотите удалить';
		header('Location:/admin/products/main');
		exit();
	} 
}


$query = q("SELECT * FROM `goods` ORDER BY `id` DESC");

if(isset($_SESSION['notice']) ) {
	$notice = $_SESSION['notice'];
	unset($_SESSION['notice']);
}