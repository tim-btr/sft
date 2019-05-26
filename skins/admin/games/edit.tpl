<form action="" method="post" class="add-form" enctype="multipart/form-data">
  <table>
    <tr>
  	  <th colspan="2" align="center">Редактирование записи</th>
  	</tr>
  	<tr>
	  <td>Выберите игровую платформу: <span>*</span></td>
  	  <td>
	    <?php 
	    while($row2 = $res->fetch_assoc()) {?>
			<label><input type="checkbox" name="platf[]" value="<?php echo $row2['id'];?>" <?php if(in_array($row2['id'], $ids)){echo 'checked';} ?>><?php echo $row2['platform']; ?></label><br>
	    <?php
	    }
	   	$res->close();
	    ?>
	  </td>
	  <td><?php if(isset($error['platf'])) { echo htmlspecialchars($error['platf']); } ?></td>
  	</tr>
	<tr>
	  <td>Впишите название игры: <span>*</span></td>
  	  <td>
	    <input type="text" name="name" value="<?php if(isset($_POST['name'])) {echo htmlspecialchars($_POST['name']); } else {echo htmlspecialchars($row['name']); }?>">
	  </td>
	  <td><?php if(isset($error['name'])) { echo htmlspecialchars($error['name']); } ?></td>
  	</tr>
	
	<tr>
	  <td>Изображение: <span>*</span></td>
  	  <td>
	    <input type="file" name="file">
	  </td>
	  <td><?php if(isset($error['file'])) { echo htmlspecialchars($error['file']); } ?></td>
  	</tr>

	<tr>
	  <td>Описание игры: <span>*</span></td>
  	  <td>
	    <textarea name="about" cols="30" rows="10"><?php if(isset($_POST['about'])) {echo htmlspecialchars($_POST['about']);} else {echo htmlspecialchars($row['about']); }?></textarea>
	  </td>
	  <td><?php if(isset($error['about'])) { echo htmlspecialchars($error['about']); } ?></td>
  	</tr>
	<tr>
  	  <td colspan="2" align="center"><input type="submit" name="edit good" value="Редактировать запись"></td>
  	</tr>
	<tr>
  	  <td colspan="2" align="center"><span>*</span> - поле обязательно для заполнения</td>
  	</tr>
  </table>
</form><div></div>