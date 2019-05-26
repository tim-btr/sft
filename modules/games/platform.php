<?php 
if(isset($_GET['key1'])) {
	$res = q("
		SELECT * FROM `platform`
		WHERE `id` = ".(int)$_GET['key1']
	);

	$res2 = q("
		SELECT `games_id` FROM `games2platform`
		WHERE `platf_id` = ".(int)$_GET['key1']
	);

	$games = array(); 

	if($res2->num_rows) {
		while($row2 = $res2->fetch_assoc()) {
			$games[] = $row2['games_id']; 
		}

		$games = implode(',', $games);

		$res3 = q("
			SELECT * FROM `games`
			WHERE `id` IN (".$games.")
		");
	}
}


if($res->num_rows) {
	$row = $res->fetch_assoc();
} else {
	$notice = 'Данной записи не существует';
}