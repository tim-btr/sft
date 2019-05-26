<?php
if((!isset($_SESSION['user']) || $_SESSION['user']['access'] != 2) && Core::$SKIN == 'admin') {
	include './modules/account/login.php';
}