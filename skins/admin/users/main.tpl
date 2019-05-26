<div class="admin-users-notice">
  <?php 
  if(isset($notice) ) {
	  echo toHtm($notice);
  }
  ?>
</div>
<p class="adm-us-search">Поиск пользователей</p>
<form action="/admin/users/main" method="post" class="user-search-form">
	<input type="text" name="user-search" placeholder="Логин или его часть">
	<input type="submit" value="Найти">
</form>
<div class="admin-users-notice"></div>
<div>
	<table class="all-users-table">
<?php 
if(isset($res)){
	while($row = $res->fetch_assoc()){?>
		<div class="admin-showall">
			<?php echo '<span>Пользователь: </span>'.$row['login'].' <span>('.$row['email'].')</span>';?>
			<div class="edits">
				<a class="admin-edit-button aeb-edt" href="/admin/users/edit-user/edit/<?php echo (int)$row['id']; ?>">Редактировать</a>
			</div>
		</div><?php		
	}
}?>
	</table>
</div>