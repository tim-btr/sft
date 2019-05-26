<div class="admin-goods-notice">
  <?php 
  if(isset($notice) ) {
	  echo toHtm($notice);
  } 
  ?>
</div>

<p>На платформе <b><?php echo $row['platform']; ?></b> играют в:</p>

<div class="games-platf">
	<ul class="platf-list">
	  <?php 
	  while($row3 = $res3->fetch_assoc()) {
	  	  echo '<a href="/games/aboutgame/'.$row3['id'].'"><li>'.$row3['name'].'</li></a>';
	  }
	  ?>
	</ul>
</div>
