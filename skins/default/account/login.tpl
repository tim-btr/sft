<div class="auth-wrap">
  <form action="/account/login" method="post" class="auth-form" onsubmit="if(!authSubm('log-auth', 'log-pass')) {return false} else {return true};">

    <p>Логин</p>
    <input type="text" name="login" id="log-auth">
    <p id="log-notice"></p>

    <p>Пароль</p>
    <input type="password" name="pass" id="log-pass">
    <p id="pass-notice"></p>

    <label><input type="checkbox" name="rememberme">Запомнить</label>

    <input type="submit" value="Авторизоваться">
    <?php 
    if(isset($status)) {
    	echo $status;
    }
    ?>
  </form>
</div>