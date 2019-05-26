<div class="admin-goods-notice">
  <?php 
  if(isset($notice) ) {
    echo toHtm($notice);
  }
  ?>
</div>
<?php 
  if(isset($_SESSION['user']) && ($_SESSION['user']['access'] >= 1 && $_SESSION['user']['access'] < 5)) { ?>
    <a href="/games/add" class="add-game">править</a>
<?php  }
?>
<div class="clear"></div>
<?php

foreach ($games as $k => $v) {
?>
  <div class="the-game">
  	<h3 class="games-name"><?php echo $v['name']; ?></h3><div class="clear"></div>
    <img src="<?php echo $v['link']; ?>" alt="game-thumb" class="games-img"> 
    <ul>
    <?php
      foreach($v as $k2 => $v2) {
        if(is_array($v2)) { 
          echo '<li><a href="/games/platform/'.$k2.'">'.$platf[$k2].'</a></li><br>';
        }
      }
    ?>  
    </ul>
    <div class="clear"></div>
    <a href="/games/aboutgame/<?php echo $v['id']; ?>" class="games-more">
	    Подробнее
    </a>

    <?php 
    if(isset($_SESSION['user']) && $_SESSION['user']['access'] == 2) { ?>
      <a class="del-from-adm" href="/admin/games/main/del/<?php echo $k; ?>">удалить</a>
    <?php 
    }
    ?>
  </div>
  <hr>
<?php
} 

?>
<div class="paginator">
	<?php $obj->getNav(); ?>
</div>

