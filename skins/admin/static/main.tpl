<div class="adm-empty">
<?php 
if((!isset($_SESSION['user']) || $_SESSION['user']['access'] != 2) && Core::$SKIN == 'admin') {
	include './skins/default/account/login.tpl';
}
?>
</div>