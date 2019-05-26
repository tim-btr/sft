<div class="admin-goods-notice">
  <?php 
  if(isset($notice) ) {
    echo toHtm($notice);
  }
  ?>
</div>

<div class="select-prod-cat">
  <form action="" method="post">
  	<select name="category">
  	<?php 
  	for($i=0; $i < count($categories); $i++) { ?>
  	 	<option value="<?php echo $categories[$i];?>"><?php echo $categories[$i];?></option>
  	<?php 
    }
  	?>
  	</select>
  	<input type="submit" value="Отсортировать">
  </form>
</div>
<?php 
  if(isset($_SESSION['user']) && ($_SESSION['user']['access'] >= 1 && $_SESSION['user']['access'] < 5)) { ?>
    <a href="/products/add" class="add-game">добавить</a>
<?php  }
?>
<div class="clear"></div>
<?php 
while($row = $query->fetch_array() ) { ?>
	<div class="prod-container">
	  <img src="<?php echo toHtm($row['link']); ?>" alt="product-image">
	  <?php 
	  if(isset($_SESSION['user']) && $_SESSION['user']['access'] == 2) { ?>
	      <a class="del-from-adm" href="/admin/products/main/del/<?php echo $row['id']?>">удалить</a>
	  <?php 
	  }
	  ?>
	  <div class="clear"></div>
	  <h3><?php echo toHtm($row['name']).' '.toHtm($row['model']); ?></h3>
	  <p><b>Категория:</b> <?php echo toHtm($row['category']); ?></p><div class="clear"></div>
	  <p class="prod-article">Код продукта: <?php echo toHtm($row['article']); ?></p>
	  <p class="prod-about"><?php echo toHtm($row['about']); ?></p>
	  <p class="prod-cost">Цена: <?php echo toHtm($row['cost']).' рублей'; ?></p>
	</div>	
<?php 
}	 
$query->close();
?>
