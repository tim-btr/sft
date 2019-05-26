<?php 
function whatis($arg) {
	echo '<pre>';
	print_r($arg);
	echo '</pre>';
} 

function __autoload($class_name) {
	include './libs/class_'.$class_name.'.php';
} 

//запрос к базе данных и логирование ошибок. 
function q($query, $key = 0) {
	$res = dbconnect::_($key)->query($query);
	if($res === false) {
		$info = debug_backtrace();	
		$date = date("Y-m-d h:m:i");
		
		$error = "Запрос не был выполнен.\r\n
		ЗАПРОС: ".$query."\r\n".dbconnect::_($key)->error."\r\n
		Выявлена ошибка в файле: ".$info[0]['file']."\r\n
		Строка: ".$info[0]['line'].', текст запроса: '.$info[0]['args'][0]."\r\n
		Время: ".$date."\r\n
		Ошибка: ".mysqli_error($con)."\r\n
		=================================";
		
		file_put_contents('./logs.log', $error."\r\n \r\n", FILE_APPEND);
		echo '<div style="color:#A5A5A5;">'.nl2br(htmlspecialchars($error)).'</div>'; 
	} 
	return $res;
}

//альтернатива для wtf()
function showArr($arg) {
	echo '<pre>';
	echo var_dump($arg); 
	echo '</pre>';
}

function toInt($arg) {
	if(!is_array($arg) ) {
		$arg = (int)$arg;
	} else {
		$arg = array_map('toInt', $arg);
	}
	return $arg;
}

function toFl($arg) {
	if(!is_array($arg) ) {
		$arg = (float)$arg;
	} else {
		$arg = array_map('toFloat', $arg);
	}
	return $arg;
}

function toHtm($arg) {
	if(!is_array($arg) ) {
		$arg = htmlspecialchars($arg);
	} else {
		$arg = array_map('toHtm', $arg);
	}
	return $arg;
}

function escStr($arg, $key=0) {
	return dbconnect::_($key)->real_escape_string($arg);
}

function myHash($var) {
	$salt = 'abc';
	$salt2 = 'aooo1a';
	$var = crypt(md5($var.$salt), $salt2);
	return $var;
}


