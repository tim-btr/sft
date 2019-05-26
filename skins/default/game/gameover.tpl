<?php
if(isset($_SESSION['client'], $_SESSION['server'])) {	  
    if($_SESSION['client'] > $_SESSION['server']) {
	    echo '<h2>Поздравляю! Ты победитель!</h2>';
	    echo '<div class="img-gameover"><img src="/img/human.jpg" alt="winner" class="border-gameover"></div>';
    } elseif($_SESSION['client'] < $_SESSION['server']) {
	    echo '<h2>Ты проигал...</h2>';
	    echo '<div class="img-gameover"><img src="/img/computer.jpg" alt="looser" class="border-gameover"></div>';
    } else {
	    echo '<h2>Равный счёт</h2>';
    }
    echo '<div class="result-gameover"><b><u>СЧЁТ</u></b><br>Человек: '.$_SESSION['client'].'<br>Компьютер: '.$_SESSION['server'].'</div>';
} else {
    echo '<h2>No data</h2>';
}
echo '<br>&lt&lt&lt<a href="/game/main&getback=1">Вернуться на исходную позицию</a>';	


