<?php 
if(!isset($_SESSION['user']) || $_SESSION['user']['access'] < 1) {
	echo '<h3 class="admin-goods-notice">Вы не авторизованы или у вас нет прав доступа</h3>';
} else { ?>
<img id="loader" src="/img/loder.gif" alt="">
<div class="comm-content">
	<?php
	while($row = mysqli_fetch_assoc($result)) { 
		if(isset($_SESSION['user']) && $_SESSION['user']['access'] == 2)  { 
			echo '<a class="del-from-adm" href="/admin/comments/main/del/'.toHtm($row['id']).'">удалить</a>';
		}
	?>
		<div class="clear"></div>
		<div class="comm"><b><?php echo toHtm($row['id']).'. '.toHtm($row['name']) ?> </b>
		<div class="comm-date"><?php echo toHtm($row['date']) ?></div><div class="clear"></div>
		<?php echo nl2br(toHtm($row['text'])) ?> </div>
		<?php 
	} 
	$result->close();
	?>
</div>
<table class="comm-table">
  <form id="commentForm" action="" method="post" onsubmit="return false;">
  <tr>
  	<td colspan="2"><p id="log-notice">&nbsp;</p></td>
  </tr>
  <tr>
	<td>Логин*</td>
	<td><input type="text" id="commLogin" name="nick_name" value="<?php if(isset($_POST['name'])) {echo toHtm($_POST['name']);} elseif(isset($_SESSION['user'])) { echo toHtm($_SESSION['user']['login']); }?>"></td>
	<td><?php if(isset($errors['name'])) { echo $errors['name']; }?></td>
  </tr>
  <tr>
	<td>Текст*</td>
	<td><textarea name="textarea" cols="60" rows="10" id="commTextArea"></textarea>  
	</td>
	<td><?php if(isset($errors['text'])) { echo $errors['text']; }?></td>
  </tr>		
  <tr>
	<td>&nbsp;</td>
	<td style="text-align:center"><input type="submit" id="idSubm" class="comm-submit"></td>
  </tr>		
  <tr>
	<td>&nbsp;</td>
	<td style="text-align:center">* - обязательные для заполнения поля</td>
  </tr>	
  </form>
</table>
<?php } ?>