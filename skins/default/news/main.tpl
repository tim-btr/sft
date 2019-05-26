<?php 
if(!isset($_SESSION['user']) || $_SESSION['user']['access'] < 1) {
	echo '<h3 class="admin-goods-notice">Вы не авторизованы или у вас нет прав доступа</h3>';
} else { ?>
<div class="comm-content"></div>

<table class="comm-table">
  <form id="newsForm" action="" method="post" onsubmit="return false;">
  <tr>
  	<td colspan="2"><p id="log-notice">&nbsp;</p></td>
  </tr>
  <tr>
	<td>Заголовок*</td>
	<td><input id="newsTitle" type="text" name="title" value="<?php if(isset($_POST['title'])) {echo toHtm($_POST['title']);}?>"></td>
	<td><?php if(isset($errors['title'])) { echo $errors['title']; }?></td>
  </tr>
  <tr>
	<td>Текст*</td>
	<td><textarea id="newsText" name="textarea" cols="60" rows="10"></textarea>  
	</td>
	<td><?php if(isset($errors['text'])) { echo $errors['text']; }?></td>
  </tr>		
  <tr>
	<td>&nbsp;</td>
	<td style="text-align:center"><input type="submit" id="newsSubm" value="Добавить новость" class="comm-submit"></td>
  </tr>		
  <tr>
	<td>&nbsp;</td>
	<td style="text-align:center">* - обязательные для заполнения поля</td>
  </tr>	
  </form>
</table>
<?php } ?>
