<?php 
//Вывод содержимого файла для логирования ошибок 
//----------------------------------------------------------
$errors_contant = file_get_contents('./db_errors.log');
echo nl2br($errors_contant);
echo '<div style="border:2px dotted black;"></div>';

// ИСПЫТАНИЕ РЕКУРСИИ ДЛЯ ПРЕОБРАЗОВАНИЯ В ЦЕЛОЧИСЛЕННЫЙ И ДРОБНЫЙ ТИПЫ.
// ----------------------------------------------------------
echo '<b>';
showArr($num_array);
echo '</b>';

$num_array = toInt($num_array);
showArr($num_array);

/*
$num_array = toFl($num_array);
showArr($num_array);
*/
echo '<div style="border:2px dotted black;"></div>';

// ИСПЫТАНИЕ РЕКУРСИИ ДЛЯ HTMLSPECIALCHARS.
// ----------------------------------------------------------
echo '<b>';
wtf($tags);
echo '</b>';

$tags = toHtm($tags);
wtf($tags);
echo '<div style="border:2px dotted black;"></div>';	

// ИСПЫТАНИЕ РЕКУРСИИ ДЛЯ MYSQLI_REAL_ESCAPE_STRING.
// ----------------------------------------------------------
echo '<b>';
wtf($db);
echo '</b>';

$db = escStr($db);
wtf($db);