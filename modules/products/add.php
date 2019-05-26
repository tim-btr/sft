<?php 
Core::$CSS[] = '<link rel="stylesheet" href="/css/game.css">';

//достаем категории
$categories = array();

$res = q("
	SELECT `category` FROM `category`
");

while($row = $res->fetch_assoc()) {
	$categories[] = $row['category'];
}

$res->close();
