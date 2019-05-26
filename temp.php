<?php
session_start();
include './libs/default.php';

echo 'POST<br>';
wtf($_POST);
echo 'COOKIE<br>';
wtf($_COOKIE);
echo 'SESSION<br>';
wtf($_SESSION);
echo 'СЕРВЕР<br>';
wtf($_SERVER);