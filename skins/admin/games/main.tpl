<div class="admin-goods-notice">
  <?php 
  if(isset($notice) ) {
	  echo toHtm($notice);
  }
  ?>
</div>
<form action="" method="post" class="admin-showallform">
  <?php if(isset($_SESSION['user']) && $_SESSION['user']['access'] == 2) { ?> 
  <div class="adm-del-buttons">
	  <input type="submit" name="delall" value="Удалить Всё" class="del-goods-submit">
    <a href="/admin/games/add" class="add-goods-submit">добавить игру</a>
	<div class="clear"></div>
  </div>
  
  <div class="adm-prod-cont"> 
  <?php 
  while($row = $query->fetch_assoc()) { ?>
	  <div class="admin-showall">
		<input type="checkbox" name="ids[]" value="<?php echo (int)$row['id']; ?>">
		<?php echo toHtm($row['name']); ?>
		<div class="edits">
		 <a class="admin-edit-button aeb-edt" href="/admin/games/edit/edit/<?php echo (int)$row['id']; ?>">Редактировать</a>
		  <a class="admin-edit-button aeb-del" href="/admin/games/main/del/<?php echo (int)$row['id']; ?>">Удалить</a>
		</div>
	  </div>
  <?php 
  }
   $query->close();
  ?>
  </div>
  <div class="adm-del-buttons">  
	  <input type="submit" name="delall" value="Удалить Всё" class="del-goods-submit">
    <a href="/admin/games/add" class="add-goods-submit">добавить игру</a>
	  <div class="clear"></div>
  </div>
  <?php
  } ?>
</form>