<?php 
$query = q("
	SELECT * FROM `comments`
	ORDER BY `id` DESC
");

if(!$query->num_rows) {
	$_SESSION['notice'] = 'Нет записей по данному запросу';
} 

if(isset($_POST['delall']) ) {
	if(isset($_POST['ids']) ) { 
		foreach($_POST['ids'] as $k=>$v) {
			$_POST['ids'][$k] = (int)$v;
		}
	
		$ids = implode(',', $_POST['ids']);
		q("
			DELETE FROM `comments`
			WHERE `id` IN (".$ids.")
		") or exit();
	
		$_SESSION['notice'] = 'Записи были успешно удалены';
		header('Location:/admin/comments/main');
		exit(); 
	} else {
		$_SESSION['notice'] = 'Вы должны выделить те записи, которые хотите удалить';
		header('Location:/admin/comments/main');
		exit();
	} 
}

if(isset($_GET['key2']) && $_GET['key2'] == 'del') {
	q("
		DELETE FROM `comments`
		WHERE `id` = '".(int)$_GET['key3']."'
	");
	$_SESSION['notice'] = 'Запись была успешно удалена.';
	header('Location:/admin/comments/main');
	exit();
}	

if(isset($_SESSION['notice']) ) {
	$notice = $_SESSION['notice'];
	unset($_SESSION['notice']);
}