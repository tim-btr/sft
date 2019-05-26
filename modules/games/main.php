<?php 
Core::$CSS[] = '<link rel="stylesheet" href="/css/games.css">';

//лимит сообщений на 1 страницу
$limit = 3;

//получаем текущую страницу делаем з
if(!isset($_GET['num']) || $_GET['num'] <= 0) {
	$_GET['num'] = 1;
} else {
	$_GET['num'] = (int)$_GET['num'];
}

//делаем общую выборку из БД
$res = q("SELECT COUNT(*) FROM `games`");
$row = $res->fetch_row();

//в классе вычисляем общее количество страниц 
$obj = new Paginator($row[0], $limit, $_GET['num']);

$res->close();

$start = ($_GET['num']*$obj->rows_each_page) - $obj->rows_each_page;
/* ======================================= */

//делаем выборку из таблицы GAMES
$res = q("
	SELECT `id`, `name`, `link` FROM `games`
	ORDER BY `id` 
	LIMIT ".$start.", ".$obj->rows_each_page."
");

$games = array();
while ($row = $res->fetch_assoc()) {
	$games[$row['id']] = $row;
}

$gids = array_keys($games); 

//делаем выборку из таблицы GAMES2PLATFORM
$res2 = q("SELECT * FROM `games2platform` WHERE `games_id` IN (".implode(',', $gids).")");
while ($row = $res2->fetch_assoc()) {
	$games[$row['games_id']][$row['platf_id']][] = $row;
}

//делаем выборку из таблицы PLATFORM
$res3 = q("SELECT * FROM `platform`");
$platf = array();
while($row = $res3->fetch_assoc()) {
	$platf[$row['id']] = $row['platform'];
}

$res->close();
$res2->close();
$res3->close();
/* ======================================= */
if(isset($_SESSION['notice']) ) {
	$notice = $_SESSION['notice'];
	unset($_SESSION['notice']);
}