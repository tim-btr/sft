<div class="admin-goods-notice">
  <?php 
  if(isset($notice) ) {
	  echo toHtm($notice);
  } 
  ?>
</div>

<div class="the-game">
  <h3 class="games-name2"><?php echo $row['name']; ?></h3>
  <img src="<?php echo $row['link']; ?>" alt="game-thumb" class="games-img"> 
  <div class="clear"></div>
  <div class="games-platf">
  	Платформа: 
  	<ul class="platf-list">
	  	<?php 
	  	while($row3 = $res3->fetch_assoc()){?>
			<a href="/games/platform/<?php  echo $row3["id"]; ?>">
				<li><?php echo $row3["platform"]; ?></li>
			</a>
		<?php
		}
	  	?>
   </ul>
  </div>
  <div class="clear"></div>
  <div class="games-descr">
  	<?php echo $row['about']; ?>
  </div>
</div>