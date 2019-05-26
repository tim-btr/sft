<?php 
if(!isset($_SESSION['user']) || $_SESSION['user']['access'] < 1) {
	echo '<h3 class="admin-goods-notice">Вы не авторизованы или у вас нет прав доступа</h3>';
} else { ?>
<div class="field">
  <div class="intro">Введите число от 1 до 3:</div>
  <form action="/game/main" method="post">
    <input type="text" name="number">
    <input type="submit" name="go" value="Отправить">
    <input type="hidden" name="id" value="<?php echo rand(1,99999) ?>">
  </form>  
  <a href="/game/main&reset=1" class="reset">Сброс Счёта</a>
</div>



<div class="main-game">
  <div class="server">
  </div>
	
<div class="output">
    <?php  
    if(isset($output)) {
	    echo $output.'<br>'; 
    }
    ?>
</div>
	
  <div class="client">
  </div>
  <div class="clear"></div>
	
  <div class="server-count">
    <h3>Счёт Компьютера</h3>
    <?php 
    if($_SESSION['server']) {
	    echo $_SESSION['server'];
    }
    ?>
  </div>
	
  <div class="client-count">
    <h3>Счёт Человека</h3>
    <?php 
    if($_SESSION['client']) {
	    echo $_SESSION['client'];
    }
    ?>
  </div>
  <div class="clear"></div>
</div>
<?php } ?>