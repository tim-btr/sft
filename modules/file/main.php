<?php
Core::$CSS[] = '<link rel="stylesheet" href="/css/file.css">';

$catalog = (isset($_GET['dir']) ? scandir($_GET['dir']) : scandir('.'));

	