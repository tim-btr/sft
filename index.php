<?php
error_reporting(-1);
ini_set('display_errors', 1);
header('Content-type: text/html; charset=utf-8');
session_start();
ob_start();

include './libs/default.php';
include './config.php';
include './controller.php';

include './'.Core::$CONT.'/allpages.php';


if(!file_exists('./'.Core::$CONT.'/'.$_GET['module'].'/'.$_GET['page'].'.php') || !file_exists('./skins/'.Core::$SKIN.'/'.$_GET['module'].'/'.$_GET['page'].'.tpl')) {
	header('Location: /errors/404');
	exit;
}

include './'.Core::$CONT.'/'.$_GET['module'].'/'.$_GET['page'].'.php';
include './skins/'.Core::$SKIN.'/'.$_GET['module'].'/'.$_GET['page'].'.tpl';

$ob_content = ob_get_contents();
ob_end_clean();

include './skins/'.Core::$SKIN.'/index.tpl';
