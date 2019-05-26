<?php 
if(isset($_GET['key1'])) {
	$res = q("
		SELECT * FROM `games`
		WHERE `id` = ".(int)$_GET['key1']
	);

	$res2 = q("
		SELECT `platf_id` FROM `games2platform`
		WHERE `games_id` = ".(int)$_GET['key1']
	);

	$platforms = array(); 

	if($res2->num_rows) {
		while($row2 = $res2->fetch_assoc()){
			$platforms[] = $row2['platf_id'];
		}

		$platforms = implode(',', $platforms);

		$res3 = q("
			SELECT * FROM `platform`
			WHERE `id` IN (".$platforms.")
		");

	}
}



if($res->num_rows) {
	$row = $res->fetch_assoc();
} else {
	$notice = 'Данной записи не существует';
}


