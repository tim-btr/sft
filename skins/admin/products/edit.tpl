<form action="" method="post" class="add-form" enctype="multipart/form-data">
  <table>
    <tr>
  	  <th colspan="2" align="center">Редактирование записи</th>
  	</tr>
  	<tr>
	  <td>Выберите категорию товара: <span>*</span></td>
  	  <td>
	    <select name="category">
		<?php
		for($i=0; $i<count($categories); ++$i) { ?>
		<option value="<?php echo htmlspecialchars($categories[$i]);?>"<?php if(isset($_POST['category']) && $categories[$i] == $_POST['category']) {echo 'selected';} elseif(!isset($_POST['category']) && $row['category']==$categories[$i]) {echo 'selected';}?>><?php echo htmlspecialchars($categories[$i]);?></option>
		<?php 
		}
		?>
	    </select>
	  </td>
	  <td><?php if(isset($error['category'])) { echo htmlspecialchars($error['category']); } ?></td>
  	</tr>
	<tr>
	  <td>Впишите наименование товара: <span>*</span></td>
  	  <td>
	    <input type="text" name="name" value="<?php if(isset($_POST['name'])) {echo htmlspecialchars($_POST['name']); } else {echo htmlspecialchars($row['name']); }?>">
	  </td>
	  <td><?php if(isset($error['name'])) { echo htmlspecialchars($error['name']); } ?></td>
  	</tr>
	<tr>
	  <td>Впишите версию/модель товара: </td>
  	  <td>
	    <input type="text" name="model" value="<?php if(isset($_POST['model'])) {echo htmlspecialchars($_POST['model']);} else {echo htmlspecialchars($row['model']);} ?>">
	  </td>
  	</tr>
	<tr>
	  <td>Цена товара: <span>*</span></td>
  	  <td>
	    <input type="text" name="cost" value="<?php if(isset($_POST['cost'])) {echo htmlspecialchars($_POST['cost']);} else {echo htmlspecialchars($row['cost']);} ?>">
	  </td>
	  <td><?php if(isset($error['cost'])) { echo htmlspecialchars($error['cost']); } ?></td>
  	</tr>
	<tr>
	  <td>Артикул/код товара: <span>*</span></td>
  	  <td>
	    <input type="text" name="article" value="<?php if(isset($_POST['article'])) {echo htmlspecialchars($_POST['article']);} else { echo htmlspecialchars($row['article']);} ?>">
	  </td>
	  <td><?php if(isset($error['article'])) { echo htmlspecialchars($error['article']); } ?></td>
  	</tr>
	<tr>
	  <td>Изображение для товара: <span>*</span></td>
  	  <td>
	    <input type="file" name="file">
	  </td>
	  <td><?php if(isset($error['file'])) { echo htmlspecialchars($error['file']); } ?></td>
  	</tr>
	<tr>
	  <td>Описание товара: <span>*</span></td>
  	  <td>
	    <textarea name="about" cols="30" rows="10"><?php if(isset($_POST['about'])) {echo htmlspecialchars($_POST['about']);} else {echo htmlspecialchars($row['about']); }?></textarea>
	  </td>
	  <td><?php if(isset($error['about'])) { echo htmlspecialchars($error['about']); } ?></td>
  	</tr>
	<tr>
  	  <td colspan="2" align="center"><input type="submit" name="edit good" value="Редактировать товар"></td>
  	</tr>
	<tr>
  	  <td colspan="2" align="center"><span>*</span> - поле обязательно для заполнения</td>
  	</tr>
  </table>
</form><div></div>