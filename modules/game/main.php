<?php
Core::$CSS[] = '<link rel="stylesheet" href="/css/game.css">';

if(isset($_GET['reset']) || (isset($_GET['getback']) && $_GET['getback'] == 1)) {
	unset($_SESSION['id'],$_SESSION['server'],$_SESSION['client']);
	header('Location: /game/main');
	exit;
} 


if(!isset($_SESSION['server'])) {
	$_SESSION['client'] = 10;
	$_SESSION['server'] = 10;
	$_SESSION['id'][] = 0;
}

if(isset($_POST['go'], $_POST['number'], $_POST['id'])) {  
	$_SESSION['id'][] = $_POST['id'];
    if(($_POST['number'] > 3 || $_POST['number'] < 1) || $_SESSION['id'][count($_SESSION['id'])-1] == $_SESSION['id'][count($_SESSION['id'])-2]) {
	    $output = 'Неверные Данные !';
    } else { 
	    $server = rand(1,3);
		$temp = rand(1,4);
		  
	    if($_POST['number'] == $server) {
		    $_SESSION['server'] -= $temp;
			$output = '<img src="/img/left.jpg" alt="arrow">'.$temp.' балл(ов) !';
	    } else {
		    $_SESSION['client'] -= $temp;
			$output = $temp.' балл(ов) ! <img src="/img/right.jpg" alt="arrow">'; 
	    }  
    }
	
} 

if(isset($_SESSION['client'], $_SESSION['server']) && ($_SESSION['client']<=0 || $_SESSION['server']<=0)) {
	header('Location: /game/gameover');
	exit;
}
