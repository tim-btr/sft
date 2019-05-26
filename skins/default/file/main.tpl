<?php 
if(!isset($_SESSION['user']) || $_SESSION['user']['access'] < 1) {
	echo '<h3 class="admin-goods-notice">Вы не авторизованы или у вас нет прав доступаБ</h3>';
} else { ?>
<div class="file-catalog">
  <?php
  foreach($catalog as $k=>$v) {
	  if(is_dir(isset($_GET['dir']) ? $_GET['dir'].'/'.$v : $v)) {
	      echo '<div class="dir-icon"></div>';
	      echo '<a href="/file/main&dir='.(isset($_GET['dir']) ? $_GET['dir'].'/'.$v : $v).'" class="dir">'.$v.'</a><br>';
      } else {
	      echo '<div class="file-icon"></div>';
	      echo '<p>'.$v.'</p><br>';
      }	
  }	
  ?>
</div>
<?php } ?>