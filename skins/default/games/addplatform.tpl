<div class="admin-goods-notice">
  <?php 
  if(isset($notice) ) {
    echo toHtm($notice);
  }
  ?>
</div>
<?php 
if(!isset($_SESSION['user']) || $_SESSION['user']['access'] < 1) {
  echo '<h3 class="admin-goods-notice">Вы не авторизованы или у вас нет прав доступа</h3>';
} else { ?>
  <form action="/admin/games/addplatform" method="post" class="add-form" enctype="multipart/form-data">
    <table>
      <tr>
    	  <th colspan="2" align="center">На этой странице вы можете добавить новые платформы к уже существующим</th>
    	</tr>
    	<tr>
    		<td><a href="/games/add">&lt;&lt;&lt;вернуться назад</a></td>
    	</tr>
    	<tr>
    		<td>
    			Список внесенных платформ <br>
  	  		<?php 
  	  			while($row = $res->fetch_assoc()) {
  	  				echo '- '.$row['platform'].'<br>';
  	  			}
  	  		?>
    		</td>
  	  </tr>
    	<tr>
  		  <td>Введите название:<span>*</span><br></td>
  		  <td>
  		  	<input type="text" name="platf">
  		  </td>
  		  <td></td>
  	  </tr>
  	  <tr>
    	  <td colspan="2" align="center"><input type="submit" name="add good" value="Внести платформу"></td>
    	</tr>
  	<tr>
    </table>
  </form>
<?php
} ?>