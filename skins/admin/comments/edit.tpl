<?php 
if(!isset($notice) ) { ?>
<table class="adm-comm-edit-table">
  <form action="" method="post">
    <tr>
       <td>Имя пользователя: <span>*</span></td>
	   <td><input type="text" name="name" value="<?php if(isset($_POST['name'])) {echo toHtm($_POST['name']);} else {echo toHtm($row['name']);} ?>"></td>
	   <td><?php if(isset($error['name'])) {echo toHtm($error['name']);} ?></td>
    </tr>
    <tr>
       <td>Текст комментария:<span>*</span></td>
	   <td>
	     <textarea name="text" cols="30" rows="10" ><?php if(isset($_POST['text'])) {echo toHtm($_POST['text']);} else {echo toHtm($row['text']);} ?></textarea>
	   </td>
	   <td><?php if(isset($error['text'])) {echo toHtm($error['text']);} ?></td>
    </tr>
    <tr>
       <td>Дата сообщения</td>
	   <td><input type="text" name="date" value="<?php if(isset($row['date'])) {echo toHtm($row['date']);} ?>"></td>
    </tr>
	<tr>
	  <td colspan="2" align="center"><input type="submit" value="Редактировать"></td>
	</tr>
	<tr>
  	  <td colspan="2" align="center"><span>*</span> - поле обязательно для заполнения</td>
  	</tr>
  </form>
</table>
<?php } else { 
	echo $notice;
}




	
	
	
	
