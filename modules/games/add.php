<?php 
Core::$CSS[] = '<link rel="stylesheet" href="/css/game.css">';

//выбираем все платформы для вывода
$res = q("
	SELECT * FROM `platform` ORDER BY `id`
");