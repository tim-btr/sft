<!DOCTYPE HTML>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="<?php echo toHtm(Core::$META['descrption']); ?>">
  <meta name="keywords" content="<?php echo toHtm(Core::$META['keywords']); ?>">
  <title><?php echo toHtm(Core::$META['title']); ?></title>
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/comments.css">
  <?php 
    if(count(Core::$CSS)) {
        echo implode('<br>', Core::$CSS);
    }
    if ($_GET['module']=='static' || $_GET['page']=='main') {
        echo '<link rel="stylesheet" href="/css/mystyle.css">';
    }
  ?>
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
  <script src="/js/jquery.min.js"></script>
  <script src="/js/script.js"></script>
  <?php
   if(count(Core::$JS)) {
        echo implode('<br>', Core::$JS);
    }
  ?>

</head>
<body>
<div class="outer-container">
  <div class="header">
    <div class="logo">
      <a href="/"><img src="/img/logo.jpg" alt="companys-logo"></a>
      <h3 class="slogan">the world of software</h3>
    </div>  	
    <div class="menu">
	<?php
	foreach($navigation as $k=>$v) {
		if($k == 'soft') {
			echo '<a href="/" class="'.($_GET['module']=='static' && $_GET['page']=='main' ? 'active-cell' : '').'">'.$v.'</a>';
		} elseif((isset($_SESSION['user']) && $_SESSION['user']['access'] >= 1) && ($k=='news' || $k=='comments')) {
			echo '<a href="/'.$k.'/main" class="'.($_GET['module']==$k ? 'active-cell' : '').'">'.$v.'</a>';
		} elseif($k == 'products' || $k == 'games') {
			echo '<a href="/'.$k.'/main" class="'.($_GET['module']==$k ? 'active-cell' : '').'">'.$v.'</a>';	
		} 
	}
	
    ?>
    </div>
	<?php
	if(!isset($_SESSION['user'])) {
		echo '<a href="/account/login" class="link-login" onclick="if(showModal(\'auth-modal\')){return true} else {return false}">Логин</a>';
		echo '<a href="/account/register" class="link-register" onclick="if(authSubm(\'reg-modal\')){return true} else {return false}" >Регистрация</a>';
	} else {
		echo '<a href="/cabinet/main/'.$_SESSION['user']['id'].'" class="cabinet">'.$_SESSION['user']['name'].'</a>';
		echo '<a href="/account/login?exit=1" class="link-login">ВЫХОД</a>';
	}
	?>
    <div class="clear"></div>
  </div>
  
  <div class="bottom">
  </div>
  
<div class="inner">
  <?php
  echo $ob_content;
  ?>
  <div class="clear"></div>
</div>
<!-- ======== Модальное окно для авторизации ======== -->
<div id="auth-modal" style="display: none;">
  <div>
    <div id="modal-closebutton" onclick="hideModal('auth-modal');">X</div>
    <?php include './skins/default/account/login.tpl'; ?>
  </div>
</div>
<!-- -------------- -->
<div id="reg-modal" style="display: none;">
  <div>
    <div id="modal-closebutton" onclick="hideModal('reg-modal');">X</div>
    <?php include './skins/default/account/register.tpl'; ?>
  </div>
</div>
<!-- ======== Конец модального окна  ======== -->
  <div class="footer">
    <div class="low-menu">
  	  <a href="#" class="first-cell">Home</a>
  	  <a href="#">Products</a>
  	  <a href="#">Revews</a>
  	  <a href="#">Downloads</a>
  	  <a href="#">FAQs</a>
  	  <a href="#">Contacts</a>
    </div>
    <div class="copy">
  	  <?php
  	  if(Core::$year == date('Y')) {
  		  echo 'Softex &copy '.Core::$year;
  	  } else {
  		  echo 'Softex &copy '.Core::$year.' - '.date('Y');
  	  }
        ?>	
  	  <a href="#">Privacy policy</a>
    </div>
    <div class="clear"></div>
  </div>

</div>
</body>
</html>