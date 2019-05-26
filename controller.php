<?php
if(isset($_GET['route'])) {
	$temp = explode('/', $_GET['route']);
	
	if($temp[0] == 'admin') {
		Core::$CONT = Core::$CONT.'/admin';
		Core::$SKIN = 'admin';
		unset($temp[0]);
	}
	
	$i = 0;
	foreach($temp as $k=>$v) {
		if($i == 0) {
			if(!empty($v)) {
				$_GET['module'] = $v;
			}
		} elseif($i == 1) {
			if(!empty($v)) {
				$_GET['page'] = $v;
			}
		} else {
			$_GET['key'.($k-1)] = $v;
		}
		++$i;
	}
	unset($_GET['route']);
}

$navigation = array(
	'soft'=>'главная',
	'products'=>'товары',
	'comments'=>'комментарии',
	'news'=>'новости',
	'games'=>'игры', 
	'game'=>'БА',
	'file'=>'файлы'
);

if(!isset($_GET['module'])) {
	$_GET['module'] = 'static';
} else {
	$res = q("
		SELECT * FROM `pages`
		WHERE `module` = '".escStr($_GET['module'])."'
		LIMIT 1
	");


	if(!$res->num_rows){
		header('Location: /errors/404');
		exit;
	} else {
		$statpage = $res->fetch_assoc();
		$res->close();

		if($statpage['static'] == 1) {
			$_GET['module'] = 'staticpage';
			$_GET['page'] = 'main';
		}
	}
}

if(!isset($_GET['page'])) {
	$_GET['page'] = 'main';
}

if(!preg_match('#^[a-z-_]{1,15}$#ui', $_GET['page'])) {
	header('Location: /errors/404');
	exit;
}